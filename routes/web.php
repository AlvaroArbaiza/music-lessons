<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//
//Route::get('/', fn () => redirect()->route('lessons.index'));
//
//Route::get('/lessons', [LessonController::class, 'index'])->name('lessons.index');
//Route::get('/lessons/{lesson}', [LessonController::class, 'show'])->name('lessons.show');
//
//Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
//Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
//Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
//

require __DIR__.'/auth.php';
