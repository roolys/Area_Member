<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route for the landing page
Route::get('/',[HomeController::class,'homepage'])->name('homepage');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//Route for redirect user or admin in her page
// Route::get('/home',[HomeController::class,'index'])->middleware('auth')->name('home');
//Route for store post in the database
// Route::post('/user_post',[HomeController::class,'user_post'])->middleware('auth')->name('user_post');
//Route for create and display post
// Route::get('/my_post',[HomeController::class,'my_post'])->middleware('auth')->name('my_post');

//Route for store comment in database
// Route::post('/comment_post',[HomeController::class,'comment_post'])->middleware('auth')->name('comment_post');
//Route for create and display comment
// Route::get('/comment',[HomeController::class,'comment'])->middleware('auth')->name('comment');

Route::get('/home', [PostsController::class, 'index']) -> middleware('auth') -> name('home');

// Route::get('/posts/new', [PostsController::class, 'create']);

Route::post('/posts', [PostsController::class, 'store']) -> middleware('auth') -> name('posts.store');

Route::get('/posts/{post}', [PostsController::class, 'show']) -> middleware('auth') -> name('posts.show');

Route::post('/posts/{post}/comments', [CommentsController::class, 'store'])-> middleware('auth') -> name('comments.store');

Route::post('/posts/{post}/comments', [CommentsController::class, 'store'])-> middleware('auth') -> name('comments.store');

Route::get('/posts/{post}/comments', [CommentsController::class, 'show'])-> middleware('auth') -> name('comments.show');




require __DIR__.'/auth.php';
