<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\linksController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\ContactController;
use Spatie\Honeypot\ProtectAgainstSpam;



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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('home');

Route::middleware(ProtectAgainstSpam::class)->group(function() {
    Auth::routes(['verify' => true]);
});    

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/product/edit/{id}', [ProductosController::class, 'edit'])->name('product.edit');
    Route::patch('/product/update/{id}', [ProductosController::class, 'update'])->name('product.update');
    Route::delete('/products/{product}/links/{link}', [ProductosController::class, 'removeLink']) ->name('products.removeLink');
    Route::resource('admin/users', AdminController::class)->names([
        'index' => 'admin.users.index',
        'edit' => 'admin.users.edit',
        'destroy' => 'admin.users.destroy',
    ]);
    Route::put('/admin/users/{user}', [AdminController::class, 'update'])->name('admin.users.update');

    Route::resource('categories', CategoryController::class);
    Route::resource('links', linksController::class);
});




Route::group(['middleware' => ['auth', 'verified']], function () {

    Route::get('/data', [CategoryController::class, 'data'])->name('categories.data');
    
    
    Route::get('/productos', [ProductosController::class, 'index'])->name('productos');
    Route::get('/product/{product}', [ProductosController::class, 'show'])->name('product');
    Route::get('/products/search', [ProductosController::class, 'search'])->name('products.search');
    Route::post('/api/product/favorite/{id}', [ProductosController::class, 'toggleFavorite']);

    
    Route::get('/search', [linksController::class, 'search'])->name('links.search');
    Route::post('/links/{link}/update-price', [linksController::class, 'updatePrice'])->name('links.updatePrice');
    Route::get('/autocomplete',  [App\Http\Controllers\linksController::class, 'autocomplete'])->name('autocomplete');

    Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.show');
    Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');
});

// Rutas de verificación de correo
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home'); // Cambia esta ruta según la lógica de tu aplicación
})->middleware(['signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Illuminate\Http\Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Email de verificación enviado.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');