<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Models\Book;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->word(),
            'review_text'=> fake()->sentence(),
            'rating' => fake()->numberBetween(1,5),
            'book_id' => function(){            
                return Book::all()->random();        // funkcija koja na slucajan nacin bira jednu od postojecih knjiga
            },
            'user_id' => function(){
                return User::all()->random();       // funkcija koja na slucajan nacin bira jednog od postojecih korisnika
            }
        ];
    }
}
