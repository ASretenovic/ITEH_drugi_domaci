<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;

class Category extends Model
{
    use HasFactory;

    protected $fillable =[
        'name','description',
    ];

    // jedna kategorija ima vise knjiga
    public function books(){
        return $this->hasMany(Book::class);
    }
}
