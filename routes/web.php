<?php

use App\Http\Controllers\OffertController;
use App\Http\Controllers\ProfileController;
use App\View\Components\Pages\AboutController;
use App\View\Components\Pages\AlliancesController;
use App\View\Components\Pages\CatalogsController;
use App\View\Components\Pages\ContactController;
use App\View\Components\Pages\ServicesController;
use App\View\Components\Pages\SpecialityAreaController;
use App\View\Components\Pages\WelcomeController;
use App\View\Components\Pages\AdminController;

use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return view('welcome');
})->name('home2');

Route::get('/', [WelcomeController::class, 'index'])->name('home');
Route::get('/app/{any}', [AdminController::class, 'index'])->middleware(['auth', 'verified'])->where('any', '.*');

Route::get('/speciality-area/{specialty}', [SpecialityAreaController::class, 'showBySpecialty'])->name('speciality-area.show');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/catalogs', [CatalogsController::class, 'index'])->name('catalogs');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/services', [ServicesController::class, 'index'])->name('services');
Route::get('/alliances', [AlliancesController::class, 'index'])->name('catalogs');



// APIS
Route::post('/api/offerts/create', [OffertController::class, 'store']);
Route::post('/api/offerts/reorder', [OffertController::class, 'reorderIndexes']);
Route::post('/api/offerts/reorder-table', [OffertController::class, 'reorder']);

Route::get('/api/offerts', [OffertController::class, 'index']);
Route::get('/api/offerts/{id}', [OffertController::class, 'show']);
Route::put('/api/offerts/{id}', [OffertController::class, 'update']);
Route::delete('/api/offerts/{id}', [OffertController::class, 'destroy']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
