<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
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


    Route::get('/user/list', [UserController::class,"list"])->name('user.list');
    Route::get('/user/form', [UserController::class,"create"])->name('user.create');
    Route::post('/user', [UserController::class,"store"])->name('user.store');
    Route::get('/user/{user}', [UserController::class,"edit"])->name('user.edit');
    Route::put("/user/{user}", [UserController::class,"update"])->name('user.update');
    Route::delete('/user/{user}', [UserController::class,"destroy"])->name('user.destroy');

    Route::get('/category/list', [CategoryController::class,"list"])->name('category.list');
    Route::get('/category/form', [CategoryController::class,"create"])->name('category.create');
    Route::post('/category', [CategoryController::class,"store"])->name('category.store');
    Route::get('/category/{category}', [CategoryController::class,"edit"])->name('category.edit');
    Route::put("/category/{category}", [CategoryController::class,"update"])->name('category.update');
    Route::delete('/category/{category}', [CategoryController::class,"destroy"])->name('category.destroy');
    Route::get('/category/desvincular/{category_post}', [CategoryController::class,"desvincular"])->name('category.desvincular');
});


Auth::routes();

