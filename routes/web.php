<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProviderController;

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
})->name('home');


// Products
Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');

route::get('list', [ProductController::class, 'list'])->name('list');
route::put('list/update/{id}', [ProductController::class, 'update'])->name('products.update');
route::delete('list/destroy/{id}', [ProductController::class, 'destroy'])->name('products.destroy');


// Providers
route::get('/providers',[ProviderController::class, 'index'])->name('providers');
route::post('/providers/store',[ProviderController::class, 'store'])->name('providers.store');
route::delete('/providers/destroy/{id}',[ProviderController::class, 'destroy'])->name('providers.destroy');
