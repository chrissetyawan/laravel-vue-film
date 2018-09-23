<?php

namespace App;

use App\Codeline\Slug\HasSlug;
use App\Codeline\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use Filterable, HasSlug;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'release_date', 'rating', 'ticket_price', 'country', 'photo'
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'genres'
    ];

    /**
     * Get the list of genres attached to the film.
     *
     * @return array
     */
    public function getGenreListAttribute()
    {
        return $this->genres->pluck('name')->toArray();
    }

    /**
     * Get the user that owns the film.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all the comments for the film.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    /**
     * Get all the tags that belong to the article.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    /**
     * Get the key name for route model binding.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the attribute name to slugify.
     *
     * @return string
     */
    public function getSlugSourceColumn()
    {
        return 'name';
    }

    /**
     * Get list of values which are not allowed for this resource
     *
     * @return array
     */
    public function getBannedSlugValues()
    {
        return ['feed'];
    }
}
