<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NewsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [NewsController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
// profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// admin
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::resource('admin/news', NewsController::class)->except(['index', 'show']);
    Route::resource('admin/faq', FAQController::class)->except(['index', 'show']);
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});
require __DIR__.'/auth.php';
