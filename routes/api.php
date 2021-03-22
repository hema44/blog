<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class,'login']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('register',[UserController::class,'store']);
});


Route::group(['middleware' => ['auth:api']], function() {
    Route::post('posts/', [PostsController::class , 'store']);
    Route::get('posts/',[PostsController::class , 'index']);
    Route::get('post/{id}',[PostsController::class , 'show']);
    Route::delete('post/{id}', [PostsController::class , 'destroy']);
    Route::put('post/{id}',[PostsController::class , 'update']);
    Route::post('comment/', [CommentsController::class , 'store']);
    Route::get('comment/',[CommentsController::class , 'index']);
    Route::get('comment/{id}',[CommentsController::class , 'show']);
    Route::delete('comment/{id}', [CommentsController::class , 'destroy']);
    Route::put('comment/{id}',[CommentsController::class , 'update']);
});
