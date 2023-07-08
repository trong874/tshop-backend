<?php

use App\Http\Controllers\Products\CategoryController;
use App\Http\Controllers\Products\ProductController;
use Illuminate\Support\Facades\Route;

Route::resources([
    'products'=> ProductController::class,
    'categories'=> CategoryController::class
]);


Route::get('get-categories',[CategoryController::class,'getAll']);
