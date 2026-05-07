<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $appends = ['image_url'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
        'category',
        'image',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Return a safe full URL for the blog image.
     * If image is an absolute URL, return as-is. If it's a storage path, return Storage::url().
     */
    public function getImageUrlAttribute()
    {
        if (empty($this->image)) {
            return null;
        }

        // If already an absolute URL
        if (preg_match('#^https?://#i', $this->image)) {
            return $this->image;
        }

        $imagePath = $this->image;
        // If legacy path like 'storage/...' or '/storage/...', strip leading 'storage/' since Storage::url expects the disk path
        if (str_starts_with($imagePath, 'storage/')) {
            $imagePath = substr($imagePath, strlen('storage/'));
        }
        if (str_starts_with($imagePath, '/storage/')) {
            $imagePath = substr($imagePath, strlen('/storage/'));
        }

        // Otherwise, assume stored in storage/app/public or a relative path
        // Use Storage::url which respects the filesystems 'public' disk url (uses APP_URL/storage)
        try {
            return \Illuminate\Support\Facades\Storage::url($imagePath);
        } catch (\Throwable $e) {
            // Fallback: prefix with app url
            return rtrim(env('APP_URL', ''), '/') . '/' . ltrim($this->image, '/');
        }
    }
}
