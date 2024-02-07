<?php

use App\Http\Controllers\Auth\authController;
use App\Http\Controllers\Auth\AuthController as AuthAuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::prefix('posts')->group(function(){
    // functiont to return all of the posts
    Route::get('/',[PostController::class,'index'])->name('posts');
});
Route::prefix('users')->group(function(){
    // functiont to return all of the posts
    Route::get('/',[UserController::class,'index'])->name('users');
    Route::get('/collections',[UserController::class,'collectionTest'])->name('collectionTest');
    Route::get('/search',[UserController::class,'search'])->name('userSearch');
});

Route::prefix('feedbacks')->group(function(){
    Route::get('/list',[FeedbackController::class,'index'])->name('feedbacksList');
    Route::get('/show/{id}',[FeedbackController::class,'show'])->name('viewFeedback');
    Route::get('/form',[FeedbackController::class,'edit'])->name('feedbackForm');
    Route::post('/send', [FeedbackController::class, 'store'])->name('feedbackSend');
});

Route::prefix('comments')->group(function(){
    Route::post('/send',[CommentController::class,'create'])->name('commentSend');
});

Route::get('/',[AuthController::class,'index'])->middleware('guest')->name('login');
Route::post('/login',[AuthController::class,'login'])->middleware('guest')->name('loginAttempt');

Route::get('/logout',[AuthAuthController::class,'logout'])->middleware('auth')->name('logout');
