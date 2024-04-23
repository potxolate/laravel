<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HospedajesController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\linksController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/hospedajes', [HospedajesController::class, 'index'])->name('hospedajes');

//Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::resource('categories', CategoryController::class);

Route::get('/productos', [ProductosController::class, 'index'])->name('productos');
Route::get('/product/{product}', [ProductosController::class, 'show'])->name('product');
Route::get('/product/edit/{id}', [ProductosController::class, 'edit'])->name('product.edit');
Route::post('/product/update/{id}', [ProductosController::class, 'update'])->name('product.update');
Route::get('/products/search', [ProductosController::class, 'search'])->name('products.search');
Route::delete('/products/{product}/links/{link}', [ProductosController::class, 'removeLink']) ->name('products.removeLink');

Auth::routes();

Route::resource('links', linksController::class);
Route::get('/search', [linksController::class, 'search'])->name('links.search');

Route::get('/autocomplete',  [App\Http\Controllers\linksController::class, 'autocomplete'])->name('autocomplete');
