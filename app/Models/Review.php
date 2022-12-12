<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use App\Models\User;

class Review extends Model
{
    use HasFactory;

    protected $fillable =[
        'title','review_text','rating'
    ];

    // jedna recenzija se odnosi na jednu knjigu
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // jednu recenziju pise samo jedan korisnik
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
