<?php

use App\Http\Controllers\auth\AuthController;
use Illuminate\Support\Facades\Route;


Route::middleware(['guest'])->group(function(){
    Route::get('/login',[AuthController::class,'login'])->name('login');
    Route::post('/login',[AuthController::class,'store'])->name('login.store');
});

Route::get('/logout',[AuthController::class,'logout'])->name('logout')->middleware(['auth']);
