<?php

namespace App\Models;

use App\User;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use RyanChandler\Comments\Concerns\HasComments;

class Book extends Model implements HasMedia
{
    use InteractsWithMedia, HasComments;

    protected $fillable = [
        'title', 'slug', 'price', 'published_date', 'author_id', 'publish', 'pdf_file', 'type_of_book', 'description'
    ];

    public function getCoverAttribute()
    {
        return $this->getFirstMedia('book');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(255)
            ->height(300)
            ->sharpen(10);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
