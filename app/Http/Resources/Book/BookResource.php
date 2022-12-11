<?php

namespace App\Http\Resources\Book;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'title'=>$this->title,
            'author'=>$this->author,
            'excerpt'=>$this->quote,
            'number_of_pages'=>$this->pages,
            'ratings'=> $this->bookReviews->count()>0 ? round($this->bookReviews->sum('rating')/$this->bookReviews->count()) : 'Reviews don`t exist.',
            'category'=>$this->category->name,
            'href'=>[
                'reviews'=>route('reviews.index',$this->id)
                ]
        ];
    }
}
