<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ActivityLogController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// admins
Route::prefix('admins')->group(function () {
    Route::post('/datatable', [AdminController::class, 'datatable'])->name('api.admin.admins.datatable');
});
// roles
Route::prefix('roles')->group(function () {
    Route::post('/datatable', [RoleController::class, 'datatable'])->name('api.admin.roles.datatable');
});
// permissions
Route::prefix('permissions')->group(function () {
    Route::post('/datatable', [PermissionController::class, 'datatable'])->name('api.admin.permissions.datatable');
});
// activity log
Route::prefix('activity-log')->group(function () {
    Route::post('/datatable', [ActivityLogController::class, 'datatable'])->name('api.admin.activity-log.datatable');
});
