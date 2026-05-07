#!/usr/bin/env php
<?php
// Usage:
// php scripts/delete_blogs_by_author.php --email=you@example.com    # dry-run: list candidate blogs by author's email
// php scripts/delete_blogs_by_author.php --user=5 --yes           # actually delete blogs for user_id=5

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

$options = [];
foreach ($argv as $arg) {
    if (str_starts_with($arg, '--email=')) $options['email'] = substr($arg, strlen('--email='));
    if (str_starts_with($arg, '--user=')) $options['user'] = (int)substr($arg, strlen('--user='));
    if ($arg === '--yes' || $arg === '-y') $options['yes'] = true;
}

if (!isset($options['email']) && !isset($options['user'])) {
    echo "Please specify --email=EMAIL or --user=ID to select the author.\n";
    echo "Example (dry-run): php scripts/delete_blogs_by_author.php --email=you@example.com\n";
    echo "Example (delete): php scripts/delete_blogs_by_author.php --email=you@example.com --yes\n";
    exit(1);
}

$author = null;
if (isset($options['email'])) {
    $author = User::where('email', $options['email'])->first();
    if (!$author) {
        echo "No user found with email {$options['email']}.\n";
        exit(1);
    }
}
if (isset($options['user'])) {
    $author = User::find($options['user']);
    if (!$author) {
        echo "No user found with id {$options['user']}.\n";
        exit(1);
    }
}

$blogs = Blog::where('user_id', $author->id)->get();
if ($blogs->isEmpty()) {
    echo "No blogs found authored by {$author->email} (id: {$author->id}).\n";
    exit(0);
}

echo "Found {$blogs->count()} blog(s) authored by {$author->email} (id: {$author->id}):\n\n";
foreach ($blogs as $b) {
    echo sprintf("[%d] %s\n    Category: %s | Created: %s\n    Image: %s\n\n", $b->id, trim(str_replace("\n"," ", strip_tags($b->title))), $b->category ?? '(none)', $b->created_at, $b->image ?? '(none)');
}

if (empty($options['yes'])) {
    echo "Dry-run. To delete these posts and their stored images, re-run with --yes\n";
    exit(0);
}

$deleted = 0;
foreach ($blogs as $b) {
    echo "Deleting blog ID {$b->id} — \"{$b->title}\" ... ";
    try {
        if (!empty($b->image)) {
            $path = $b->image;
            if (str_starts_with($path, '/storage/')) $path = substr($path, 9);
            if (str_starts_with($path, 'storage/')) $path = substr($path, 8);
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
                echo " removed image ({$path}) ";
            }
        }
    } catch (\Throwable $e) {
        echo "(warning removing image: {$e->getMessage()}) ";
    }
    try {
        $b->delete();
        echo " OK\n";
        $deleted++;
    } catch (\Throwable $e) {
        echo "FAILED ({$e->getMessage()})\n";
    }
}

echo "\nCompleted. Deleted {$deleted} blog(s).\n";
