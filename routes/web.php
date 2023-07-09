<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('posts')->group(function(){
    Route::get('index',[PostController::class, 'index'])->name('posts.index');
    Route::get('create',[PostController::class, 'create'])->name('posts.create')->middleware('auth');
    Route::post('store',[PostController::class, 'store'])->name('posts.store')->middleware('auth');
    Route::get('show/{post}',[PostController::class, 'show'])->name('posts.show');
});