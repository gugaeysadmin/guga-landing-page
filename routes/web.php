<?php

use App\Http\Controllers\AccesoryPdfController;
use App\Http\Controllers\AllianceController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CatalogCatController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\OffertController;
use App\Http\Controllers\PageConfigController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductSpecAreaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SpecAreaController;
use App\Http\Controllers\TableHeaderController;
use App\View\Components\Pages\AboutController;
use App\View\Components\Pages\AlliancesController;

use App\View\Components\Pages\CatalogsController;
use App\View\Components\Pages\ContactController;
use App\View\Components\Pages\ServiceContactController;
use App\View\Components\Pages\ServicesController;
use App\View\Components\Pages\SpecialityAreaController;
use App\View\Components\Pages\WelcomeController;
use App\View\Components\Pages\AdminController;

use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return view('welcome');
})->name('home2');

Route::get('/', [WelcomeController::class, 'index'])->name('home');
Route::get('/app/{any}', [AdminController::class, 'index'])->middleware(['auth', 'verified'])->where('any', '.*')->name('app.admin');

Route::get('/speciality-area/{specialty}', [SpecialityAreaController::class, 'showBySpecialty'])->name('speciality-area.show');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/catalogs', [CatalogsController::class, 'index'])->name('catalogs');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/services', [ServicesController::class, 'index'])->name('services');
Route::get('/services/contact/{service}', [ServiceContactController::class, 'showByService'])->name('serviceContact');

Route::get('/alliances', [AlliancesController::class, 'index'])->name('alliances');



// APIS

// Ofertas
Route::post('/api/offerts/create', [OffertController::class, 'store']);
Route::post('/api/offerts/reorder', [OffertController::class, 'reorderIndexes']);
Route::post('/api/offerts/reorder-table', [OffertController::class, 'reorder']);
Route::get('/api/offerts', [OffertController::class, 'index']);
Route::get('/api/offerts/{id}', [OffertController::class, 'show']);
Route::put('/api/offerts/{id}', [OffertController::class, 'update']);
Route::delete('/api/offerts/{id}', [OffertController::class, 'destroy']);
Route::get('/api/offerts-count/', [OffertController::class, 'counting']);

// Alianzas
Route::post('/api/alliances/create', [AllianceController::class, 'store']);
Route::post('/api/alliances/reorder', [AllianceController::class, 'reorderIndexes']);
Route::post('/api/alliances/reorder-table', [AllianceController::class, 'reorder']);
Route::get('/api/alliances', [AllianceController::class, 'index']);
Route::get('/api/alliances/{id}', [AllianceController::class, 'show']);
Route::put('/api/alliances/{id}', [AllianceController::class, 'update']);
Route::delete('/api/alliances/{id}', [AllianceController::class, 'destroy']);
Route::get('/api/alliances-count/', [AllianceController::class, 'counting']);

//Areas de especialidad
Route::post('/api/speciality-areas/create', [SpecAreaController::class, 'store']);
Route::post('/api/speciality-areas/reorder', [SpecAreaController::class, 'reorderIndexes']);
Route::post('/api/speciality-areas/reorder-table', [SpecAreaController::class, 'reorder']);
Route::get('/api/speciality-areas', [SpecAreaController::class, 'index']);
Route::get('/api/speciality-areas/{id}', [SpecAreaController::class, 'show']);
Route::post('/api/speciality-areas/update/{id}', [SpecAreaController::class, 'update']);
Route::delete('/api/speciality-areas/{id}', [SpecAreaController::class, 'destroy']);

//Servicios
Route::post('/api/services/create', [ServiceController::class, 'store']);
Route::post('/api/services/reorder', [ServiceController::class, 'reorderIndexes']);
Route::post('/api/services/reorder-table', [ServiceController::class, 'reorder']);
Route::get('/api/services', [ServiceController::class, 'index']);
Route::get('/api/services/{id}', [ServiceController::class, 'show']);
Route::put('/api/services/{id}', [ServiceController::class, 'update']);
Route::delete('/api/services/{id}', [ServiceController::class, 'destroy']);


//Marcas
Route::post('/api/brand/create', [BrandController::class, 'store']);
Route::get('/api/brand', [BrandController::class, 'index']);
Route::get('/api/brand/{id}', [BrandController::class, 'show']);
Route::put('/api/brand/{id}', [BrandController::class, 'update']);
Route::delete('/api/brand/{id}', [BrandController::class, 'destroy']);
Route::post('/api/brand/create-on', [BrandController::class, 'onlyname']);

//PDF Accesorios
Route::post('/api/accesory-pdf/create', [AccesoryPdfController::class, 'store']);
Route::get('/api/accesory-pdf', [AccesoryPdfController::class, 'index']);
Route::get('/api/accesory-pdf/{id}', [AccesoryPdfController::class, 'show']);
Route::put('/api/accesory-pdf/{id}', [AccesoryPdfController::class, 'update']);
Route::delete('/api/accesory-pdf/{id}', [AccesoryPdfController::class, 'destroy']);


//Categorias
Route::post('/api/category/create', [CategoriesController::class, 'store']);
Route::get('/api/category', [CategoriesController::class, 'index']);
Route::get('/api/category/{id}', [CategoriesController::class, 'show']);
Route::put('/api/category/{id}', [CategoriesController::class, 'update']);
Route::delete('/api/category/{id}', [CategoriesController::class, 'destroy']);

//Seccion de catálogos
Route::post('/api/catalog-section/create', [CatalogCatController::class, 'store']);
Route::get('/api/catalog-section', [CatalogCatController::class, 'index']);
Route::get('/api/catalog-section/{id}', [CatalogCatController::class, 'show']);
Route::put('/api/catalog-section/{id}', [CatalogCatController::class, 'update']);
Route::delete('/api/catalog-section/{id}', [CatalogCatController::class, 'destroy']);

//Seccion de catálogos
Route::post('/api/lp-config/create', [PageConfigController::class, 'store']);
Route::post('/api/lp-config/update', [PageConfigController::class, 'update']);
Route::get('/api/lp-config', [PageConfigController::class, 'index']);
Route::get('/api/lp-config/{id}', [PageConfigController::class, 'show']);

//Table Headers
Route::post('/api/th-conf/create', [TableHeaderController::class, 'store']);
Route::get('/api/th-conf', [TableHeaderController::class, 'index']);
Route::get('/api/th-conf/{id}', [TableHeaderController::class, 'show']);
Route::post('/api/th-conf/{id}', [TableHeaderController::class, 'update']);
Route::delete('/api/th-conf/{id}', [TableHeaderController::class, 'destroy']);


// Productos
Route::post('/api/product/create', [ProductController::class, 'store']);
Route::post('/api/product/reorder', action: [ProductController::class, 'reorderIndexes']);
Route::post('/api/product/reorder-table', [ProductController::class, 'reorder']);
Route::get('/api/product', [ProductController::class, 'index']);
Route::get('/api/product/{id}', [ProductController::class, 'show']);
Route::post('/api/product/{id}', [ProductController::class, 'update']);
Route::put('/api/product/{id}', [ProductController::class, 'status']);
Route::get('/api/product-count/', [ProductController::class, 'counting']);

Route::delete('/api/product/{id}', [ProductController::class, 'destroy']);


// Product spec area

Route::post('/api/product-specarea/create', [ProductSpecAreaController::class, 'store']);
Route::post('/api/product-specarea/reorder', action: [ProductSpecAreaController::class, 'reorderIndexes']);
Route::post('/api/product-specarea/reorder-table', [ProductSpecAreaController::class, 'reorder']);
Route::get('/api/product-specarea', [ProductSpecAreaController::class, 'index']);
Route::get('/api/product-specarea/{id}', [ProductSpecAreaController::class, 'show']);
Route::put('/api/product-specarea/{id}', [ProductSpecAreaController::class, 'update']);
Route::delete('/api/product-specarea/{id}', [ProductSpecAreaController::class, 'destroy']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
