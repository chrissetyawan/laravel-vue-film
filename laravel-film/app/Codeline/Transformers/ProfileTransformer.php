<?php

namespace App\Codeline\Transformers;

class ProfileTransformer extends Transformer
{
    protected $resourceName = 'profile';

    public function transform($data)
    {
        return [
            'username'  => $data['username'],
            'bio'       => $data['bio'],
            'image'     => $data['image']
        ];
    }
}