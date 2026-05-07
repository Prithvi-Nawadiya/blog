#!/usr/bin/env php
<?php
// Usage:
// php scripts/clear_demo_blogs.php         # dry-run: list candidate demo/sample blogs
// php scripts/clear_demo_blogs.php --yes  # actually delete matched blogs and their stored images

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

// Bootstrap the kernel so Eloquent and config are available
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Blog;
use Illuminate\Support\Facades\Storage;

// Conservative patterns for demo/seeded content
$patterns = [
    'lorem ipsum',
    'lorem',
    'ipsum',
    'demo',
    'sample',
    'example',
    'faker',
    'generated',
    'placeholder',
    'test post',
    'jobyaari',
];

// Build query
$query = Blog::query();
$query->where(function($q) use ($patterns) {
    foreach ($patterns as $p) {
        $p = trim($p);
        $q->orWhere('title', 'LIKE', "%{$p}%");
        $q->orWhere('content', 'LIKE', "%{$p}%");
    }
});

$candidates = $query->orderBy('created_at', 'asc')->get();

if ($candidates->isEmpty()) {
    echo "No demo/sample blogs were detected by the conservative pattern matcher.\n";
    echo "If you expected some to be detected, run a broader search in tinker or adjust the patterns in scripts/clear_demo_blogs.php.\n";
    exit(0);
}

// Print list
echo "Found {$candidates->count()} candidate demo/sample blog(s):\n\n";
foreach ($candidates as $b) {
    $img = $b->image ?? '(none)';
    echo sprintf("[%d] %s\n    Category: %s | Created: %s\n    Image: %s\n\n", $b->id, trim(str_replace("\n"," ", strip_tags($b->title))), $b->category ?? '(none)', $b->created_at, $img);
}

// Parse flags
$yes = in_array('--yes', $argv, true) || in_array('-y', $argv, true);

if (!$yes) {
    echo "This is a dry-run. To delete these posts and their stored images, re-run:\n\n";
    echo "    php scripts/clear_demo_blogs.php --yes\n\n";
    exit(0);
}

// Confirm interactively if running in a TTY and not explicitly forced
if (posix_isatty(STDIN) && !$yes) {
    echo "Proceed with deletion? (y/N): ";
    $handle = fopen("php://stdin", "r");
    $line = fgets($handle);
    $confirmed = strtolower(trim($line)) === 'y';
    if (!$confirmed) {
        echo "Aborted. No changes made.\n";
        exit(1);
    }
}

// Proceed to delete each candidate carefully
$deleted = 0;
foreach ($candidates as $b) {
    echo "Deleting blog ID {$b->id} — \"{$b->title}\" ... ";
    // Delete image from storage if it's a local disk path
    try {
        if (!empty($b->image)) {
            // normalize path: if Storage::exists
            $path = $b->image;
            // strip possible leading '/storage/'
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
exit(0);
