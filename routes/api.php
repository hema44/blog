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
Route::get('comments',[CommentsController::class,'show']);
Route::post('insert',[CommentsController::class,'store']);
Route::get('delete',[CommentsController::class,'destroy']);

Route::post('user/insert',[UserController::class,'store']);
Route::get('user',[UserController::class,'show']);
Route::delete('/user/{id}',[UserController::class , 'destroy']);

Route::post('post/insert',[PostsController::class,'store']);
Route::get('posts',[PostsController::class,'show']);
Route::delete('/post/{id}',[PostsController::class , 'destroy']);
