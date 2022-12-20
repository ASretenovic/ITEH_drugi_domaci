<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\UserRegisterController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// ruta za prikazivanje svih knjiga
Route::apiResource('/books','App\Http\Controllers\BookController');


Route::group(['prefix'=>'books'],function()
{
    // neophodno je navesti celu putanju do kontrolera
    Route::apiResource('{book}/reviews','App\Http\Controllers\ReviewController')->middleware('auth:api');
});


Route::apiResource('/category','App\Http\Controllers\CategoryController')->middleware('auth:api');
Route::apiResource('/category/{category}','App\Http\Controllers\CategoryController')->middleware('auth:api');

Route::post('/register', [UserRegisterController::class, 'register']);
Route::post('/login', [UserLoginController::class, 'login']);


