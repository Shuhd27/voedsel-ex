<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\DB;
// food package families
use App\Http\Controllers\FoodPackageController;
use App\Http\Controllers\FamilyController;

Route::get('/', function () {
    return view('welcome');
});

// food package families
Route::get('/family', [FamilyController::class, 'index'])->name('family.index');
Route::get('/family/{id}', [FamilyController::class, 'show'])->name('family.show');
Route::get('/family/{id}/edit', [FamilyController::class, 'edit'])->name('family.edit');
Route::put('/family/{id}', [FamilyController::class, 'update'])->name('family.update');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/warehouse', [\App\Http\Controllers\WarehouseController::class, 'index'])->name('warehouse.index');
    Route::get('/warehouse/{id}', [\App\Http\Controllers\WarehouseController::class, 'show'])->name('warehouse.show');
    Route::get('/warehouse/{id}/edit', [\App\Http\Controllers\WarehouseController::class, 'edit'])->name('warehouse.edit');
    Route::put('/warehouse/{id}', [\App\Http\Controllers\WarehouseController::class, 'update'])->name('warehouse.update');
});

require __DIR__.'/auth.php';
