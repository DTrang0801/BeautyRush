<?php

use Illuminate\Support\Facades\Route;


// Public pages
Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');

Route::get('/account', [App\Http\Controllers\AccountController::class, 'index'])->name('account');
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact');
Route::get('/faq', [App\Http\Controllers\FaqController::class, 'index'])->name('faq');
Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products');


// Admin pages
Route::prefix('admin')->name('admin.')->group(function(){

    Route::resource('categories', App\Http\Controllers\admin\CategoryController::class)->except(['show']);

    //Route::get('categories', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('categories.index');
    //Route::get('categories/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('categories.create');
    //Route::post('categories/create', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('categories.store');

});




Route::get('/dashboard', function () {
    return view('userzone.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [App\Http\Controllers\Userzone\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\Userzone\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\Userzone\ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

