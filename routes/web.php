<?php

use App\Http\Controllers\home;
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

Route::get('/', [home::class, 'index']);
Route::get('/article/{id}', [home::class, 'show'])->name('article.show');
Route::get('/search', [home::class, 'search'])->name('search');
