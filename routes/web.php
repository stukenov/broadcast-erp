<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ScheduleController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('inventories', InventoryController::class);
    Route::resource('sales', SaleController::class);
    Route::resource('purchases', PurchaseController::class);

    Route::middleware(['role:admin,manager'])->group(function () {
        Route::resource('finances', FinanceController::class);
        Route::get('/finance-report', [FinanceController::class, 'report'])->name('finances.report');
    });

    Route::middleware(['role:admin'])->group(function () {
        // Add admin-only routes here
    });

    Route::resource('suppliers', SupplierController::class);
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserManagementController::class, 'create'])->name('users.create');
    Route::post('/users', [UserManagementController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserManagementController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserManagementController::class, 'update'])->name('users.update');
});

Route::resource('programs', ProgramController::class);

Route::resource('schedules', ScheduleController::class);
