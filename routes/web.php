<?php

use App\Http\Controllers\home;
use App\Livewire\extra;
use App\Livewire\contact;
use Livewire\Livewire;
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

Route::get('/', [home::class, 'index'])->name('home');
Route::get('/article/{id}', [home::class, 'show'])->name('article.show');
// Route::get('/extra/{id}', function ($id) {
//     return Livewire::mount('extra', ['id' => $id]);
// });
Route::get('/extra/{id}', [extra::class, 'render'])->name('extra');
Route::get('/search', [home::class, 'search'])->name('search');
Route::get('/teachers', [home::class, 'teachers'])->name('teachers');
Route::post('/contact', [home::class, 'contact'])->name('contact');
Route::get('/capctha/{config?}', [contact::class, 'flat'])->name('captcha');
