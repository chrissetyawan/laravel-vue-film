<?php

use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\DB;
// use App\Genre;

class DummyDataSeeder extends Seeder
{
    /**
     * Total number of users.
     *
     * @var int
     */
    protected $totalUsers = 3;

    /**
     * Total number of genres.
     *
     * @var int
     */
    protected $totalGenres = 5;

    /**
     * Maximum films that can be created by a user.
     *
     * @var int
     */
    protected $maxFilmsByUser = 3;

    /**
     * Maximum genres that can be attached to an film.
     *
     * @var int
     */
    protected $maxFilmGenres = 5;

    /**
     * Maximum number of comments that can be added to an film.
     *
     * @var int
     */
    protected $maxCommentsInFilm = 1;

    /**
     * Populate the database with dummy data for testing.
     * Complete dummy data generation including relationships.
     * Set the property values as required before running database seeder.
     *
     * @param \Faker\Generator $faker
     */
    public function run(\Faker\Generator $faker)
    {
        $users = factory(\App\User::class)->times($this->totalUsers)->create();

        // $genres = factory(\App\Genre::class)->times($this->totalGenres)->create();

        $genre = new App\Genre();
        $genre->name = "horror";
        $genre->save();

        $genre = new App\Genre();
        $genre->name = "action";
        $genre->save();

        $genre = new App\Genre();
        $genre->name = "drama";
        $genre->save();

        $genre = new App\Genre();
        $genre->name = "scifi";
        $genre->save();

        $genre = new App\Genre();
        $genre->name = "comedy";
        $genre->save();

        $genres = App\Genre::all();

        $users->random((int) $this->totalUsers)
            ->each(function ($user) use ($faker, $genres) {
                $user->films()
                    ->saveMany(
                        factory(\App\Film::class)
                        ->times($faker->numberBetween(1, $this->maxFilmsByUser))
                        ->make()
                    )
                    ->each(function ($film) use ($faker, $genres) {
                        $film->genres()->attach(
                            $genres->random($faker->numberBetween(1, min($this->maxFilmGenres, $this->totalGenres)))
                        );
                    })
                    ->each(function ($film) use ($faker) {
                        $film->comments()
                            ->saveMany(
                                factory(\App\Comment::class)
                                ->times($faker->numberBetween(1, $this->maxCommentsInFilm))
                                ->make()
                            );
                    });
            });
        
       
    }
}
