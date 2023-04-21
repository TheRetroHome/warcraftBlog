<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminPanel\CategoryController;
use App\Http\Controllers\AdminPanel\MainPostController;
use App\Http\Controllers\SearchController;
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
    Route::get('login',[HomeController::class,'loginForm'])->name('login.create');
    Route::get('register',[HomeController::class,'registerForm'])->name('register.create');
    Route::post('login',[HomeController::class,'login'])->name('login.store');
    Route::post('register',[HomeController::class,'register'])->name('register.store');
});
Route::group(['middleware'=>'auth'], function(){
    Route::get('logout',[HomeController::class,'logout'])->name('logout');
});
Route::group(['prefix'=>'admin','middleware'=>'admin'],function(){
    Route::get('/',[AdminController::class,'index'])->name('admin.index');
    Route::resource('/post', MainPostController::class);
    Route::resource('/category', CategoryController::class);
});
