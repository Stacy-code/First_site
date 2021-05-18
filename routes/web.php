<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\CallbackController;
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
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/callback', [HomeController::class, 'callback'])->name('callback');


/**
 * Роути адмінки
 */
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('post', CallbackController::class);
    Route::post('post/confirm', [CallbackController::class, 'confirm'])->name('post.confirm');

});
