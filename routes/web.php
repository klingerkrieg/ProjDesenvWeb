<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Auth;


#paginas externas
Route::get('/',        [HomePageController::class,"index"])->name('home_page');
Route::get('/about',   [HomePageController::class,"about"])->name('about');
Route::get('/post',    [App\Http\Controllers\PostController::class,"index"])->name('post');
Route::get('/contact', [ContactController::class,"index"])->name('contact');

#paginas internas
Route::get('/home', [HomeController::class, 'index'])->name('home');

#Abrir a postagem
Route::get('/post/open/{post:slug}',[App\Http\Controllers\PostController::class,"get"])->name('post.open');



Route::middleware(['auth'])->group(function () {
    Route::get('/post/list', [PostController::class,"list"])->name('post.list');
    Route::get('/post/form', [PostController::class,"create"])->name('post.create');
    Route::post('/post', [PostController::class,"store"])->name('post.store');
    Route::get('/post/{post}', [PostController::class,"edit"])->name('post.edit');
    Route::put("/post/{post}", [PostController::class,"update"])->name('post.update');
    Route::delete('/post/{post}', [PostController::class,"destroy"])->name('post.destroy');


    Route::get('/user/list', [Usercontroller::class,"list"])->name('user.list');
    Route::get('/user/form', [Usercontroller::class,"create"])->name('user.create');
    Route::post('/user', [Usercontroller::class,"store"])->name('user.store');
    Route::get('/user/{user}', [Usercontroller::class,"edit"])->name('user.edit');
    Route::put("/user/{user}", [Usercontroller::class,"update"])->name('user.update');
    Route::delete('/user/{user}', [Usercontroller::class,"destroy"])->name('user.destroy');
});


Auth::routes();

