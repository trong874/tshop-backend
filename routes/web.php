<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::view('/','pages.index')->middleware('auth');
});

Route::get('trongne',[\App\Http\Controllers\product\CategoryController::class,'test']);
