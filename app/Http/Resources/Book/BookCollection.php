<?php

namespace App\Http\Resources\Book;

use Illuminate\Http\Resources\Json\JsonResource;

class BookCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    //public static $wrap = 'book';

    public function toArray($request)
    {
        return [
            'title'=>$this->title,
            'author'=>$this->author,
            'ratings'=> $this->bookReviews->count()>0 ? round($this->bookReviews->sum('rating')/$this->bookReviews->count()) : 'Reviews don`t exist.',
            'href'=>[
                'book_details'=>route('books.show',$this->id)
                ]
        ];
    }
}
