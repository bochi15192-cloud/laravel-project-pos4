<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;

// Customer Routes
Route::get('/', function () {return view('home');})->name('home');
Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
Route::get('/customers/edit/{customer}',[CustomerController::class,'edit'])->name('customers.edit');
Route::put('/customers/update/{customer}',[CustomerController::class,'update'])->name('customers.update');
Route::delete('/customers/destroy/{customer}',[CustomerController::class,'destroy'])->name('customers.destroy');


// Product Routes
Route::get('/', function () {return view('home');})->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/edit/{product}',[ProductController::class,'edit'])->name('products.edit');
Route::put('/products/update/{product}',[ProductController::class,'update'])->name('products.update');
Route::delete('/products/destroy/{product}',[ProductController::class,'destroy'])->name('products.destroy');
