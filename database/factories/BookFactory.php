<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Models\Category;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
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
            'author'=> fake()->name(),
            'quote' => fake()->sentence(),
            'pages' => fake()->numberBetween(20,2000),
            'category_id' => function(){
                return Category::all()->random();
            },
            // samo admin moze da dodaje knjige u bazu
            'admin_id' => function(){
                return User::where('user_type','=',1)->get()->random();
            }
        ];
    }
}
