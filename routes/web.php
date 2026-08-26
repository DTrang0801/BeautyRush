<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TipController;
use App\Http\Controllers\Userzone\ProfileController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

// Public pages
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::get('/account', [AccountController::class, 'index'])->name('account');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/faq', [FaqController::class, 'index'])->name('faq');
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/tips', [TipController::class, 'index'])->name('tips.index');

// Admin pages
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    Route::resource('categories', CategoryController::class)->except(['show']);

    // Route::get('categories', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('categories.index');
    // Route::get('categories/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('categories.create');
    // Route::post('categories/create', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('categories.store');

});

Route::get('/dashboard', function () {
    return view('userzone.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('/account/tips', [TipController::class, 'store'])->name('account.tips.store');
    Route::put('/account/tips/{tip}', [TipController::class, 'update'])->name('account.tips.update');
    Route::delete('/account/tips/{tip}', [TipController::class, 'destroy'])->name('account.tips.destroy');
    Route::delete('/account/reviews/{review}', [ReviewController::class, 'destroy'])->name('account.reviews.destroy');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
