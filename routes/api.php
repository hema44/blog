<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostsController;

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
// this all Request for[posts-users-comments] without any auth
Route::get('comments',[CommentsController::class,'getdata']);
Route::post('insert',[CommentsController::class,'insert']);
Route::get('delete',[CommentsController::class,'delete']);

Route::post('user/insert',[UserController::class,'insert']);
Route::get('user',[UserController::class,'getdata']);
Route::delete('/user/{id}',[UserController::class , 'delete']);

Route::post('post/insert',[PostsController::class,'insert']);
Route::get('posts',[PostsController::class,'getdata']);
Route::delete('/post/{id}',[PostsController::class , 'delete']);
