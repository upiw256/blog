<?php

use App\Http\Controllers\home;
use App\Livewire\Extra;
use App\Livewire\Contact;
use App\Livewire\AchievementShow;
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
Route::get('/article/{slug}', [home::class, 'show'])->name('article.show');
// Route::get('/extra/{id}', function ($id) {
//     return Livewire::mount('extra', ['id' => $id]);
// });
Route::get('/extra/{id}', [extra::class, 'render'])->name('extra');
Route::get('/achievement/{id}', [AchievementShow::class, 'render'])->name('achievement');
Route::get('/search', [home::class, 'search'])->name('search');
Route::get('/teachers', [home::class, 'teachers'])->name('teachers');
Route::post('/contact', [home::class, 'contact'])->name('contact');
Route::get('/capctha/{config?}', [contact::class, 'flat'])->name('captcha');
