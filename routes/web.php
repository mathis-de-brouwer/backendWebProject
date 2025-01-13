<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [NewsController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// contact
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// faq
Route::get('/faq', [FAQController::class, 'index'])->name('faq.index');


// profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// admin
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::resource('admin/news', NewsController::class)->except(['index', 'show']);
    Route::get('/admin/messages', [ContactController::class, 'index'])->name('contact.index');
    Route::resource('faq', FAQController::class)->except(['index']);

});
require __DIR__.'/auth.php';
