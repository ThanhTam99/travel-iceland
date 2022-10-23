<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [IndexController::class,'home']);
Route::get('/dich-vu', [IndexController::class,'dichvu'])->name('dichvu'); // all services
Route::get('/dich-vu/{slug}', [IndexController::class,'dichvucon'])->name('dichvucon'); // sub service
Route::get('/danh-muc', [IndexController::class,'danhmuc'])->name('danhmuc'); // all categories
Route::get('/danh-muc/{slug}', [IndexController::class,'danhmuccon'])->name('danhmuccon'); // all categories
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
// Category
Route::resource('/category', CategoryController::class);