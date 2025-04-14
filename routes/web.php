<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PassportController;

Route::get('/', function () {
    return view('auth.register');
});


Route::resource('/users',UserController::class)->names('users');
Route::resource('/posts',PassportController::class)->names('posts');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/posts/create', [PassportController::class, 'create'])->name('posts.create');
    Route::get( '/posts/{post}/edit', [PassportController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PassportController::class, 'update'])->name('posts.update');
});
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [UserController::class, 'index'])->name('users.index');
    Route::post('/login', [UserController::class, 'login'])->name('login');
    Route::get('users/create', [UserController::class,'create'])->name('users.create');
    Route::post('users/create', [UserController::class,'store'])->name('users.store');

});