<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\Admin\CollectionController;

Route::get('/', [WebsiteController::class, 'home'])->name('home');
Route::get('/gallery', [WebsiteController::class, 'gallery'])->name('gallery');
Route::get('/collections', [WebsiteController::class, 'collections'])->name('collections');
Route::get('/collection/{id}', [WebsiteController::class, 'collection'])->name('collection.detail');

// Contact form submission
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

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
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('collections', CollectionController::class);
    Route::resource('gallery', GalleryController::class)->only(['index','create','store','destroy']);
    
    // Contact Messages
    Route::get('contact-messages', [App\Http\Controllers\Admin\ContactMessageController::class, 'index'])->name('contact-messages.index');
    Route::get('contact-messages/{id}', [App\Http\Controllers\Admin\ContactMessageController::class, 'show'])->name('contact-messages.show');
    Route::patch('contact-messages/{id}/status', [App\Http\Controllers\Admin\ContactMessageController::class, 'updateStatus'])->name('contact-messages.update-status');
    Route::delete('contact-messages/{id}', [App\Http\Controllers\Admin\ContactMessageController::class, 'destroy'])->name('contact-messages.destroy');
    Route::post('contact-messages/bulk-action', [App\Http\Controllers\Admin\ContactMessageController::class, 'bulkAction'])->name('contact-messages.bulk-action');
});

// فایل احراز هویت Breeze
require __DIR__.'/auth.php';