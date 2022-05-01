<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CategoryController;

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

Auth::routes(['register' => false]);

Route::get('/', [HomeController::class, 'index']);
Route::get('/{post:slug}', [HomeController::class, 'show'])->name('post.detail');

Route::prefix('admin')
    ->middleware('auth')
    ->group(function() {
         // Route::resource('category', CategoryController::class, ['as' => 'admin']);
         Route::resource('category', CategoryController::class);
         Route::resource('tag', TagController::class);
         Route::resource('post', PostController::class);
    });
