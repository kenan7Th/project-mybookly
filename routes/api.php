<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/userregister', [AuthController::class, 'userregister']);
Route::post('/userlogin', [AuthController::class, 'userlogin']);
Route::post('/userlogout', [AuthController::class, 'userlogout'])->middleware('auth:sanctum');

// Route::middleware('auth:sanctum')->group(function () {
    
// });

Route::post('/posts', [PostController::class, 'store'])->middleware('auth:sanctum');
;

//showingsinglePostForSingleUser

Route::get('/showingsinglePostForSingleUser',[PostController::class, 'showingsinglePostForSingleUser'])->middleware('auth:sanctum');

//post routes
Route::get('/posts',[PostController::class, 'index']);
//Route::post('/posts',[PostController::class, 'store']);//create port 
Route::get('/posts/{id}',[PostController::class, 'show']);//get single post 
Route::put('/posts/{id}',[PostController::class, 'update']);//update single post 
Route::delete('/posts/{id}',[PostController::class, 'destroy']);//delete post



// Comment routes
Route::get('/posts/{id}/comments',[CommentController::class, 'index']);//all comments of a post
Route::post('/posts/{id}/comments',[PostController::class, 'store']);//create port 
Route::put('/comments/{id}',[PostController::class, 'update']);//update single post 
Route::delete('/comments/{id}',[PostController::class, 'destroy']);//delete post


//like routes
Route::post('/post/{id}/likes',[LikeController::class,'likeorunlike ']);