<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SolvedProblemController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/search', [SearchController::class, 'search']);

Route::get('/', function(){
    return view('welcome');
});

Route::get('/check-account', function(){
    return view('check-account');
})->name('check-account');


Route::middleware('auth')->group(function () {
    Route::get('/administrator', [AdminController::class, 'usersshow']);
    Route::get('/users/delete', [AdminController::class, 'usersdelete']);
    Route::get('/home', [HomeController::class, 'home'])->name('home');
    Route::get('/posting', [InputController::class, 'show']);
    Route::get('/report', [AdminController::class, 'report']);
    Route::get('/reportadd', [AdminController::class, 'reportstore']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::get('/posts/topic/{uuid}', [PostController::class, 'show']);
    Route::get('/posts/delete', [AdminController::class, 'postsdelete']);
    Route::get('/solvedproblem', [SolvedProblemController::class, 'add']);
    Route::get('/comments', [CommentsController::class, 'store']);
    Route::get('/deletecomment', [CommentsController::class, 'deletecomment']);
    Route::get('/deletereply', [CommentsController::class, 'deletereply']);
    Route::get('/reply', [CommentsController::class, 'storereply']);
    Route::get('/delete/posts', [PostController::class, 'delete']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
