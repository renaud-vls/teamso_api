<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientRegistrationController;
use App\Http\Controllers\CotisationController;
use App\Http\Controllers\RetraitController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DepotController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;

Route::apiResource('clients', ClientController::class);
Route::apiResource('client-registrations', ClientRegistrationController::class);
Route::apiResource('cotisations', CotisationController::class);
Route::apiResource('retraits', RetraitController::class);
Route::apiResource('transactions', TransactionController::class);
Route::apiResource('depots', DepotController::class);

Route::get('admin/registrations', [AdminController::class, 'index'])->name('admin.registrations');
Route::get('admin/registrations', [AdminController::class, 'showRegistrations'])->name('admin.registrations');

Route::post('admin/registrations/{id}/approve', [AdminController::class, 'approve'])->name('admin.registrations.approve');

Route::get('dashboard', [DashboardController::class, 'index']);
