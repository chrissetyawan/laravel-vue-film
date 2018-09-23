<?php

namespace App\Http\Controllers\Api;

use App\Genre;
use App\Film;
use App\Codeline\Paginate\Paginate;
use App\Codeline\Filters\FilmFilter;
use App\Http\Requests\Api\CreateFilm;
use App\Http\Requests\Api\UpdateFilm;
use App\Http\Requests\Api\DeleteFilm;
use App\Codeline\Transformers\FilmTransformer;

class FilmController extends ApiController
{
    /**
     * FilmController constructor.
     *
     * @param FilmTransformer $transformer
     */
    public function __construct(FilmTransformer $transformer)
    {
        $this->transformer = $transformer;

        $this->middleware('auth.api')->except(['index', 'show']);
        $this->middleware('auth.api:optional')->only(['index', 'show']);
    }

    /**
     * Get all the films.
     *
     * @param FilmFilter $filter
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(FilmFilter $filter)
    {
        $films = new Paginate(Film::filter($filter));

        return $this->respondWithPagination($films);
    }

    /**
     * Create a new film and return the film if successful.
     *
     * @param CreateFilm $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateFilm $request)
    {
        $user = auth()->user();

        // \Log::info('request=' . $request->getContent());

        $film = $user->films()->create([
            'name' => $request->input('film.name'),
            'description' => $request->input('film.description'),
            'name' => $request->input('film.name'),
            'release_date' => $request->input('film.release_date'),
            'rating' => $request->input('film.rating'),
            'ticket_price' => $request->input('film.ticket_price'),
            'country' => $request->input('film.country'),
            'photo' => $request->input('film.photo')
        ]);
        
        // \Log::info('film=' . $film);

        $inputGenres = $request->input('film.genreList');

        if ($inputGenres && ! empty($inputGenres)) {

            $genres = array_map(function($name) {
                return Genre::firstOrCreate(['name' => $name])->id;
            }, $inputGenres);

            $film->genres()->attach($genres);
        }

        return $this->respondWithTransformer($film);
    }

    /**
     * Get the film given by its slug.
     *
     * @param Film $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Film $film)
    {
        return $this->respondWithTransformer($film);
    }

}
