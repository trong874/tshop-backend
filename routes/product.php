<?php

use App\Http\Controllers\product\CategoryController;
use App\Http\Controllers\product\ProductController;
use Illuminate\Support\Facades\Route;

Route::resources([
    'products'=> ProductController::class,
    'categories'=> CategoryController::class
]);


Route::get('get-categories',[CategoryController::class,'getAll']);


Route::get('test',function () {
    $data = \App\Models\Category::query()->updateOrCreate([
        'id'=>5
    ],
    [
        'name'=>'rong ne',
    ]
    );
    dd($data);
});
