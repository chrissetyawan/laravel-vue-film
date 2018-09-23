<?php

namespace App\Codeline\Transformers;

class FilmTransformer extends Transformer
{
    protected $resourceName = 'film';

    public function transform($data)
    {
        return [
            'slug'              => $data['slug'],
            'name'              => $data['name'],
            'description'       => $data['description'],
            'release_date'      => $data['release_date'],
            'rating'            => $data['rating'],
            'ticket_price'      => $data['ticket_price'],
            'country'           => $data['country'],
            'genreList'         => $data['genreList'],
            'photo'             => $data['photo'],
            'createdAt'         => $data['created_at']->toAtomString(),
            'updatedAt'         => $data['updated_at']->toAtomString(),
            'author' => [
                'username'  => $data['user']['username'],
                'bio'       => $data['user']['bio'],
                'image'     => $data['user']['image'],
                'following' => $data['user']['following'],
            ]
        ];
    }
}