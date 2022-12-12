<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Book;
use App\Models\User;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Http\Resources\ReviewResource;
use Symfony\Component\HttpFoundation\Response;
use App\Exceptions\UserIsNotAuthorized ;
use App\Exceptions\ReviewDoesNotBelongToUser;
use Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Book $book)
    {
        //return $book;
        return ReviewResource::collection($book->bookReviews);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReviewRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReviewRequest $request,Book $book)
    {
        // samo registrovani korisnici mogu da dodaju recenziju
        $this->addReviewUserCheck();

        $review = new Review;
        $review->title = $request->title;
        $review->review_text = $request->review_text;
        $review->rating = $request->rating;
        $review->book_id = $book->id;
        $review->user_id = Auth::id();

        $review->save();

        return response([
            'data'=> new ReviewResource($review)
        ],Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book,Review $review)
    {
        return new ReviewResource($review);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReviewRequest  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReviewRequest $request,Book $book, Review $review)
    {
        $this->ReviewCheckUser($review);

        $review->update($request->all());

        return response([
            'data'=> new ReviewResource($review)
        ],Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book,Review $review)
    {
        $this->ReviewCheckUser($review);
        
        $review->delete();
        return response(null,Response::HTTP_NO_CONTENT);
    }


    public function ReviewCheckUser($review)
    {
        $users = User::all();
        foreach($users as $user){
            if(Auth::id() == $review->user_id){
                return true;
            }
        }
        throw new ReviewDoesNotBelongToUser;
    }

    public function addReviewUserCheck(){
        $users = User::all();
        foreach($users as $user){
            if(Auth::id() == $user->id){
                return true;
            }
        }
        throw new UserIsNotAuthorized;
    }
}
