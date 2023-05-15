<?php

use App\Http\Controllers\permission\PermissionController;
use App\Http\Controllers\permission\RoleController;
use Illuminate\Support\Facades\Route;


Route::resources([
    '/roles'=> RoleController::class,
    '/permissions'=> PermissionController::class
]);

Route::post('get-list-role',[RoleController::class,'getListRole']);
Route::post('get-list-permission',[PermissionController::class,'getListPermission']);

Route::post('get-role-rights/{id}',[RoleController::class,'getRoleRights']);

Route::post('get-new-permission/{id}',[RoleController::class,'getPermissions']);
Route::post('give-permission/{role}',[RoleController::class,'givePermission']);

Route::post('revoke-permission/{role}',[RoleController::class,'revokePermission']);

Route::post('destroy-roles',[RoleController::class,'destroy']);
