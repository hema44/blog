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
    Route::post('post/', [PostController::class , 'store']);
    Route::get('post/',[PostController::class , 'index']);
    Route::get('post/{id}',[PostController::class , 'show']);
    Route::delete('post/{id}', [PostController::class , 'destroy']);
    Route::put('post/{id}',[PostController::class , 'update']);


    Route::post('comment/', [CommentController::class , 'store']);
    Route::get('comment/',[CommentController::class , 'index']);
    Route::get('comment/{id}',[CommentController::class , 'show']);
    Route::delete('comment/{id}', [CommentController::class , 'destroy']);
    Route::put('comment/{id}',[CommentController::class , 'update']);
});
