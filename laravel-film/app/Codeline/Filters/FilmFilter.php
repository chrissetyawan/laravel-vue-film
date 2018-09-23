<?php

namespace App\Codeline\Filters;

use App\Genre;
use App\User;

class FilmFilter extends Filter
{
    /**
     * Filter by author username.
     * Get all the films by the user with given username.
     *
     * @param $username
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function author($username)
    {
        $user = User::whereUsername($username)->first();

        $userId = $user ? $user->id : null;

        return $this->builder->whereUserId($userId);
    }

    /**
     * Filter by genre name.
     * Get all the genres by the given genre name.
     *
     * @param $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function genre($name)
    {
        $genre = Genre::whereName($name)->first();

        $genreIds = $genre ? $genre->films()->pluck('genre_id')->toArray() : [];

        return $this->builder->whereIn('id', $genreIds);
    }
}