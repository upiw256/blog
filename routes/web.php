<?php

use App\Http\Controllers\home;
use App\Livewire\Extra;
use App\Livewire\Contact;
use App\Livewire\AchievementShow;
use Livewire\Livewire;
use Illuminate\Support\Facades\Route;
use App\Filament\Resources\StudentResource\Pages\Student;
use App\Http\Livewire\SearchGraduation;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\apiClassRoom;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ScheduleController;

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
Route::get('/student/{record}/download', [Student::class, 'downloadStudentData'])->name('student.download')->where('record', '[0-9]+');
Route::get('/graduations', function () {
    return view('graduations.index');
});
Route::get('/download-certificate/{id}', [CertificateController::class, 'download'])->name('download-certificate');

Route::middleware(['auth', 'role:kurikulum'])->group(function () {
    Route::get('/classes', [apiClassRoom::class, 'index'])->name('classes.index');
    Route::get('/attendances', [AttendanceController::class, 'index'])->name('attendances.index');
    Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedules.index');
});
