<?php

namespace App\Http\Requests\Api;

class CreateFilm extends ApiRequest
{
    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    protected function validationData()
    {
        return $this->get('film') ?: [];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'release_date' => 'required|string',
            'rating' => 'required|string',
            'ticket_price' => 'required|string',
            'country' => 'required|string',
            'photo' => 'required|string',
            'genreList' => 'sometimes|array',
        ];
    }
}
