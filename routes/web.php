<?php

use Illuminate\Support\Facades\Route;


// Public pages
Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');

Route::get('/faq', [App\Http\Controllers\FaqController::class, 'index'])->name('faq');


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

