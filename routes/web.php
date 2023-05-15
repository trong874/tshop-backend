<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::view('/','pages.index')->middleware('auth');
});
