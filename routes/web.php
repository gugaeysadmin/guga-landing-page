<?php

use App\Http\Controllers\ProfileController;
use App\View\Components\SpecialityAreaController;
use App\View\Components\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return view('welcome');
})->name('home2');

Route::get('/', [WelcomeController::class, 'index'])->name('home');
Route::get('/specielity-area/{specialty}', [SpecialityAreaController::class, 'showBySpecialty'])->name('speciality-area.show');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
