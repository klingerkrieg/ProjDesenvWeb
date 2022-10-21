<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ContactController;


Route::get('/', [HomePageController::class,"index"])->name('home');

Route::get('/home', [HomePageController::class, 'index'])->name('home');
Route::get('/about',   [HomePageController::class,"about"])->name('about');
Route::get('/post',    [PostController::class,"index"])->name('post');
Route::get('/contact', [ContactController::class,"index"])->name('contact');

Auth::routes();

