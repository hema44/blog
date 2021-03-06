<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
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



Route::middleware(['jwt.verify'])->group(function() {
    Route::get('notify',[UserController::class,'shownotifiction']);

    Route::post('posts/', [PostController::class , 'store']);
    Route::get('posts/',[PostController::class , 'index']);
    Route::get('post/{id}',[PostController::class , 'show']);
    Route::middleware('user.verify')->group(function (){
        Route::delete('post/{id}', [PostController::class , 'destroy']);
        Route::put('post/{id}',[PostController::class , 'update']);
    });

    Route::post('comments/', [CommentController::class , 'store']);
    Route::get('comments/',[CommentController::class , 'index']);
    Route::get('comment/{id}',[CommentController::class , 'show']);
    Route::middleware('comment.verify')->group(function (){
        Route::delete('comment/{id}', [CommentController::class , 'destroy']);
        Route::put('comment/{id}',[CommentController::class , 'update']);
    });
});
