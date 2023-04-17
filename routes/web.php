<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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
Route::get('login',[HomeController::class,'loginForm'])->name('login.create');
Route::get('register',[HomeController::class,'registerForm'])->name('register.create');
Route::post('login',[HomeController::class,'login'])->name('login.store');
Route::post('register',[HomeController::class,'register'])->name('register.store');
Route::get('logout',[HomeController::class,'logout'])->name('logout');
