<?php

use App\Http\Controllers\JobsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



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


// get all users list
Route::get("/user", [UserController::class, 'index']);

// show post for each user
Route::get('/user/post/{id}', [UserController::class, 'userPost']);

// show detail for each user
Route::get("/user/detail/{id}", [UserController::class, 'userDetail']);

// update profile for each user
Route::put('/user/{id}', [UserController::class, 'update']);

// delate user 
Route::delete('/user/{id]', [UserController::class, 'destroy']);


// get all posts list
Route::get('/post/{status}', [PostController::class, 'index']);

// create a post
Route::post('/post', [PostController::class, 'store']);

Route::post("/login", [UserController::class, 'login']);
Route::post("/register", [UserController::class, 'store']);
