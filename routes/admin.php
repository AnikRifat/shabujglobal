<?php

use App\Http\Controllers\DataTableController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->middleware("can:role,'admin'")->group(function () {

    //user
    Route::get('', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('store', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('edit/{user}', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('update/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::get('delete/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

Route::prefix('role')->middleware("can:role,'admin'")->group(function () {
    // Roles
    Route::get('', [RoleController::class, 'index'])->name('admin.roles.index');
    Route::get('create', [RoleController::class, 'create'])->name('admin.roles.create');
    Route::post('store', [RoleController::class, 'store'])->name('admin.roles.store');
    Route::get('edit/{role}', [RoleController::class, 'edit'])->name('admin.roles.edit');
    Route::put('update{role}', [RoleController::class, 'update'])->name('admin.roles.update');
    Route::get('delete/{role}', [RoleController::class, 'destroy'])->name('admin.roles.destroy');
});
Route::prefix('permissions')->middleware("can:role,'admin'")->group(function () {
    // Permissions
    Route::get('', [PermissionController::class, 'index'])->name('admin.permissions.index');
    Route::get('create', [PermissionController::class, 'create'])->name('admin.permissions.create');
    Route::post('store', [PermissionController::class, 'store'])->name('admin.permissions.store');
    Route::get('edit/{permission}', [PermissionController::class, 'edit'])->name('admin.permissions.edit');
    Route::put('update/{permission}', [PermissionController::class, 'update'])->name('admin.permissions.update');
    Route::get('delete/{permission}', [PermissionController::class, 'destroy'])->name('admin.permissions.destroy');
});



Route::prefix('application')->group(function () {
    Route::get('', [ApplicationController::class, 'index'])->name('admin.application.index')->middleware("can:permission,'show application'");
    Route::get('create', [ApplicationController::class, 'create'])->name('admin.application.create')->middleware("can:permission,'create application'");
    Route::post('store', [ApplicationController::class, 'store'])->name('admin.application.store')->middleware("can:permission,'create application'");
    Route::get('edit/{application}', [ApplicationController::class, 'edit'])->name('admin.application.edit')->middleware("can:permission,'update application'");
    Route::get('active/{application}', [ApplicationController::class, 'active'])->name('admin.application.active')->middleware("can:permission,'update application'");
    Route::get('cancel/{application}', [ApplicationController::class, 'cancel'])->name('admin.application.cancel')->middleware("can:permission,'update application'");
    Route::get('delete/{application}', [ApplicationController::class, 'destroy'])->name('admin.application.destroy')->middleware("can:permission,'delete application'");
    // Route::get('test/{test}', [ApplicationController::class, 'test'])->name('admin.application.test')->middleware("can:permission,'delete application'");
});

Route::prefix('datatable')->group(function () {

    Route::get('users', [DataTableController::class, 'users'])->name('datatable.users')->middleware("can:permission,'view user'");
    Route::get('applications', [DataTableController::class, 'applications'])->name('datatable.applications')->middleware("can:permission,'show application'");

});
