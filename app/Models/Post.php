<?php

namespace App\Models;

use App\Observers\PostObserver;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Commentable;
use App\Traits\Reactable;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Post extends Model
{
    use HasFactory, Sluggable, Commentable, Reactable;

    protected $fillable = [
        'developer_name',  // New field
        'developer_link',  // New field
        'repack_features',
    ];

    protected $casts = [
        'release_date' => 'date:Y-m-d',
        'arguments' => 'object',
    ];

    public static function boot()
    {
        parent::boot();
    }

    /**
     * Get the path to the image file.
     *
     * @param string $imageField
     * @return string
     */
    protected function getImagePath($imageField)
    {
        if ($this->$imageField) {
            $folderDate = $this->created_at->translatedFormat('m-Y');
            $imageName = $this->$imageField;
            $imagePath = config('attr.poster.path') . $folderDate . '/' . $imageName;

            return $imagePath;
        } else {
            return '';
        }
    }

    /**
     * Get the URL to the image, using WebP if available.
     *
     * @param string $imageField
     * @param string $tmdbSize
     * @return string
     */
    public function getWebpImageUrl($imageField, $tmdbSize = 'w300')
    {
        $imagePath = $this->getImagePath($imageField);

        if ($imagePath) {
            $webpImagePath = preg_replace('/\.(jpg|jpeg|png|gif)$/i', '.webp', $imagePath);

            if (file_exists(public_path($webpImagePath))) {
                return asset($webpImagePath);
            } else {
                return asset($imagePath);
            }
        } elseif (config('settings.tmdb_image') == 'active' && $this->tmdb_image) {
            // Use TMDB image
            return 'https://image.tmdb.org/t/p/' . $tmdbSize . $this->tmdb_image;
        } else {
            return '';
        }
    }

    public function getImageUrlAttribute()
    {
        return $this->getWebpImageUrl('image', 'w300');
    }

    public function getCoverUrlAttribute()
    {
        return $this->getWebpImageUrl('cover', 'w1280_and_h720_bestv2');
    }

    public function getSlideUrlAttribute()
    {
        return $this->getWebpImageUrl('slide', 'w1920_and_h800_multi_faces');
    }

    public function getStoryUrlAttribute()
    {
        return $this->getWebpImageUrl('story', 'w235_and_h235_face');
    }

    public function scopeSearchUrl(Builder $query, $value)
    {
        return $query->where('title', 'like', '%' . $value . '%');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tagged_id');
    }

    public function seasons()
    {
        return $this->hasMany(PostSeason::class);
    }

    public function episodes()
    {
        return $this->hasMany(PostEpisode::class)->where('status', 'publish');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'post_genres', 'post_id', 'genre_id');
    }

    public function videos()
    {
        return $this->morphMany(PostVideo::class, 'Postable')->whereNot('type', 'download');
    }

    public function downloads()
    {
        return $this->morphMany(PostVideo::class, 'Postable')->where('type', 'download');
    }

    public function subtitles()
    {
        return $this->morphMany(PostSubtitle::class, 'Postable');
    }

    public function peoples()
    {
        return $this->belongsToMany(People::class, 'post_peoples', 'post_id', 'people_id');
    }

    public function scene()
    {
        return $this->belongsTo('App\Models\Scene');
    }

    public function watchlist()
    {
        return $this->morphToMany(User::class, 'postable', 'watchlists');
    }

    public function report()
    {
        return $this->morphMany(Report::class, 'postable');
    }

    public function reactions(): MorphMany
    {
        return $this->morphMany(Reaction::class, 'reactable');
    }

    public function logs(): MorphMany
    {
        return $this->morphMany(Log::class, 'postable');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }
}
