<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Blog;

class NormalizeBlogImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:normalize-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Normalize blog image paths stored in the database (strip leading /storage/ or leading /)';

    public function handle()
    {
        $this->info('Scanning blogs for image path normalization...');
        $count = 0;
        Blog::chunk(100, function($blogs) use (&$count) {
            foreach ($blogs as $blog) {
                if (empty($blog->image)) continue;

                $orig = $blog->image;
                $normalized = $orig;

                // Strip leading '/storage/' or 'storage/'
                if (str_starts_with($normalized, '/storage/')) {
                    $normalized = substr($normalized, strlen('/storage/'));
                } elseif (str_starts_with($normalized, 'storage/')) {
                    $normalized = substr($normalized, strlen('storage/'));
                }

                // If it starts with a leading slash but points to 'blogs/...' remove the slash
                if (str_starts_with($normalized, '/')) {
                    // only strip if it looks like a disk path (contains 'blogs/')
                    if (str_contains($normalized, 'blogs/')) {
                        $normalized = ltrim($normalized, '/');
                    }
                }

                if ($normalized !== $orig) {
                    $blog->image = $normalized;
                    $blog->save();
                    $count++;
                    $this->line("Updated blog {$blog->id}: {$orig} -> {$normalized}");
                }
            }
        });

        $this->info("Normalization complete. Updated {$count} records.");
        return 0;
    }
}
