<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\Book\BookResource;
use App\Http\Resources\Book\BookCollection;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{


    public function __construct()
    {
        // autentifikacija neophodna, osim za prikaz knjiga
        $this->middleware('auth:api')->except('index','show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BookCollection::collection(Book::paginate(4));                   // sve knjige iz baze, ali po 4 se prikazuju na jednoj stanici
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
     * @param  \App\Http\Requests\StoreBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        $book = new Book;
        $book->title = $request->title;
        $book->author = $request->author;
        $book->quote = $request->excerpt;
        $book->pages = $request->number_of_pages;
        $book->category_id = $request->category;

        $book->save();

        return response([
            'data'=> new BookResource($book)
        ],Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //return $book;                    // vraca sve podatke iz baze o datoj knjizi
        return new BookResource($book);    // vraca samo podatke definisane u BookResource
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookRequest  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    // $request sadrzi nove(izmenjene) podatke, a $book sve(stare) podatke
    public function update(UpdateBookRequest $request, Book $book)
    {

        $request['quote'] = $request->excerpt;
        unset($request['excerpt']);

        $request['pages'] = $request->number_of_pages;
        unset($request['number_of_pages']);

        $book->update($request->all());

        return response([
            'data'=> new BookResource($book)
        ],Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return response(null,Response::HTTP_NO_CONTENT);
    }
}
