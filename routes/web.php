<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\Admin\CollectionController;

Route::get('/', [WebsiteController::class, 'home'])->name('home');



// داشبورد فقط برای کاربران لاگین‌کرده
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// مسیرهای پروفایل (برای ویرایش یوزر)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// مسیرهای پنل مدیریت (فقط با لاگین)
//Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
  //  Route::resource('collections', CollectionController::class);
    //Route::resource('gallery', GalleryController::class);
//});
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('collections', AdminCollectionController::class);
    Route::resource('gallery',     AdminGalleryController::class)->only(['index','create','store','destroy']);
});
// فایل احراز هویت Breeze
require __DIR__.'/auth.php';
