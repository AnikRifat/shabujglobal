<?php

use App\Http\Controllers\DataTableController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware("can:role,'admin'")->group(function () {

    //user
    Route::get('users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::get('delete/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    // Applications
    Route::get('applications', [ApplicationController::class, 'index'])->name('admin.applications.index');
    Route::get('applications/create', [ApplicationController::class, 'create'])->name('admin.applications.create');
    Route::post('applications', [ApplicationController::class, 'store'])->name('admin.applications.store');
    Route::get('applications/{application}/edit', [ApplicationController::class, 'edit'])->name('admin.applications.edit');
    Route::put('applications/{application}', [ApplicationController::class, 'update'])->name('admin.applications.update');
    Route::get('delete/applications/{application}', [ApplicationController::class, 'destroy'])->name('admin.applications.destroy');

    // Roles
    Route::get('roles', [RoleController::class, 'index'])->name('admin.roles.index');
    Route::get('roles/create', [RoleController::class, 'create'])->name('admin.roles.create');
    Route::post('roles', [RoleController::class, 'store'])->name('admin.roles.store');
    Route::get('roles/{role}/edit', [RoleController::class, 'edit'])->name('admin.roles.edit');
    Route::put('roles/{role}', [RoleController::class, 'update'])->name('admin.roles.update');
    Route::get('delete/roles/{role}', [RoleController::class, 'destroy'])->name('admin.roles.destroy');

    // Permissions
    Route::get('permissions', [PermissionController::class, 'index'])->name('admin.permissions.index');
    Route::get('permissions/create', [PermissionController::class, 'create'])->name('admin.permissions.create');
    Route::post('permissions', [PermissionController::class, 'store'])->name('admin.permissions.store');
    Route::get('permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('admin.permissions.edit');
    Route::put('permissions/{permission}', [PermissionController::class, 'update'])->name('admin.permissions.update');
    Route::get('delete/permissions/{permission}', [PermissionController::class, 'destroy'])->name('admin.permissions.destroy');

});

Route::middleware("can:role,'admin','employee'")->group(function () {

    // Applications
    Route::get('applications', [ApplicationController::class, 'index'])->name('admin.applications.index')->middleware("can:permission,'show application'");
    Route::get('applications/create', [ApplicationController::class, 'create'])->name('admin.applications.create')->middleware("can:permission,'create application'");
    Route::post('applications', [ApplicationController::class, 'store'])->name('admin.applications.store')->middleware("can:permission,'create application'");
    Route::get('applications/{application}/edit', [ApplicationController::class, 'edit'])->name('admin.applications.edit')->middleware("can:permission,'update application'");
    Route::put('applications/{application}', [ApplicationController::class, 'update'])->name('admin.applications.update')->middleware("can:permission,'update application'");
    Route::get('delete/applications/{application}', [ApplicationController::class, 'destroy'])->name('admin.applications.destroy')->middleware("can:permission,'delete application'");

});

Route::prefix('datatable')->group(function () {

    Route::get('users', [DataTableController::class, 'users'])->name('datatable.users')->middleware("can:permission,'view user'");
    Route::get('applications', [DataTableController::class, 'applications'])->name('datatable.applications')->middleware("can:permission,'show application'");

});
