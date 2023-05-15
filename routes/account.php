<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;

Route::resource('accounts', AccountController::class);
Route::post('get-list-account',[AccountController::class,'getListAccount']);
Route::post('get-role-user/{user_id}',[AccountController::class,'getRoleUser']);
Route::post('get-user-role-not-apply/{user_id}',[AccountController::class,'getRoleNotApply']);

Route::post('give-role-user/{user_id}',[AccountController::class,'giveRole']);

Route::post('remove-roles/{user_id}',[AccountController::class,'removeRoles']);
