<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Review;

class Book extends Model
{
    use HasFactory;


    protected $fillable =[
        'title','author','quote','pages'

    ];

    // jedna knjiga pripada jednoj kategoriji
    public function category(){
        return $this->belongsTo(Category::class);
    }

    // za jednu knjigu postoji vise recenzija
    public function bookReviews(){
        return $this->hasMany(Review::class);
    }
}
