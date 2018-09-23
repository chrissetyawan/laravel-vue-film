<?php

namespace App\Codeline\Transformers;

class GenreTransformer extends Transformer
{
    protected $resourceName = 'genre';

    public function transform($data)
    {
        return $data;
    }
}