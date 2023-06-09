<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminPanel\CategoryController;
use App\Http\Controllers\AdminPanel\MainPostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
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

Route::get('/',[HomeController::class,'home'])->name('home');
Route::get('/article/{slug}',[HomeController::class,'show'])->name('post.single');
Route::get('/search',[SearchController::class,'index'])->name('search');
Route::get('/category/{slug}',[HomeController::class,'showCategoryPosts'])->name('category.single');
Route::group(['middleware'=>'guest'], function(){
    Route::get('login',[HomeController::class,'loginForm'])->name('login');
    Route::get('register',[HomeController::class,'registerForm'])->name('register');
    Route::post('login',[HomeController::class,'login'])->name('login.store');
    Route::post('register',[HomeController::class,'register'])->name('register.store');
});

Route::group(['middleware'=>'guest'], function(){
    Route::get('forgot',[HomeController::class,'forgotPassword'])->name('forgotPassword');
    Route::post('forgot',[HomeController::class,'storeForgotPassword'])->name('storeForgotPassword');
});

Route::group(['middleware'=>'auth'], function(){
    Route::get('logout',[HomeController::class,'logout'])->name('logout');
    Route::delete('/comment/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::post('/post/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('likes.store');
    Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('likes.destroy');

});

Route::group(['prefix'=>'admin','middleware'=>'admin'],function(){
    Route::get('/',[AdminController::class,'index'])->name('admin.index');
    Route::resource('/post', MainPostController::class);
    Route::resource('/category', CategoryController::class);
});
