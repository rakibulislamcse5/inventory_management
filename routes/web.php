<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Products;
use App\Http\Controllers\Sales;
use App\Http\Controllers\Categories;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

// home page
//Route::get('/',[HomeController::class,'index']);
Route::get('/', function(){
    return redirect('/product');
});
Route::get('/home', function(){
    return redirect('/product');
});
// product page
Route::get('/product',[Products::class,'index'])->middleware(['auth'])->name('product');
Route::get('/product/Add',[Products::class,'add'])->middleware(['auth'])->name('product.add');
Route::get('/product/Update/{id}',[Products::class,'update'])->middleware(['auth']);
// Product Actions
Route::post('/product/addAction',[Products::class,'ActionAdd'])->middleware(['auth']);
Route::post('/product/updateAction/{id}',[Products::class,'ActionUpdate'])->middleware(['auth']);
Route::get('/product/deleteAction/{id}',[Products::class,'ActionDelete'])->middleware(['auth']);

// category
Route::get('/category',[Categories::class,'index'])->middleware(['auth'])->name('category');
Route::get('/category/Add',[Categories::class,'add'])->middleware(['auth'])->name('category.add');
Route::get('/category/Update/{id}',[Categories::class,'update'])->middleware(['auth']);
// Category Actions
Route::post('/category/addAction',[Categories::class,'ActionAdd'])->middleware(['auth']);
Route::post('/category/updateAction/{id}',[Categories::class,'ActionUpdate'])->middleware(['auth']);
Route::get('/category/deleteAction/{id}',[Categories::class,'ActionDelete'])->middleware(['auth']);

// sale
Route::get('/Sales',[Sales::class,'index'])->middleware(['auth'])->name('sales');
Route::get('/Sales/Add',[Sales::class,'add'])->middleware(['auth'])->name('sales.add');
Route::get('/Sales/Update/{id}',[Sales::class,'update'])->middleware(['auth']);
// sale Actions
Route::post('/Sales/addAction',[Sales::class,'ActionAdd'])->middleware(['auth']);
Route::post('/Sales/updateAction/{id}',[Sales::class,'ActionUpdate'])->middleware(['auth']);
Route::get('/Sales/deleteAction/{id}',[Sales::class,'ActionDelete'])->middleware(['auth']);

