<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LendingController;
use App\Http\Controllers\AdminNotificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');

Route::get('book/index', [BookController::class, 'index'])->name('book.index');
Route::get('book/storeform', [BookController::class, 'storeform'])->name('book.storeform');
Route::post('book/store', [BookController::class, 'store'])->name('book.store');
Route::get('book/edit/{id}', [BookController::class, 'updateform'])->name('book.edit');
Route::put('book/update/{id}', [BookController::class, 'update'])->name('book.update');
Route::DELETE('book/delete/{id}', [BookController::class, 'delete'])->name('book.delete');
Route::get('admin/notification', [AdminNotificationController::class, 'notification'])->name('admin.notification');
Route::get('admin/history', [AdminNotificationController::class, 'history'])->name('admin.history');
Route::get('admin/returnRequest', [AdminNotificationController::class, 'returnRequest'])->name('admin.returnRequest');
Route::post('admin/acceptReturn/{id}', [AdminNotificationController::class, 'acceptReturn'])->name('admin.acceptReturn');




Route::get('user/book/{id}', [HomeController::class, 'bookDetails'])->name('user.book.details');
route::get('user/book/orderpage/{id}', [LendingController::class, 'lendingform'])->name('user.book.orderpage');
Route::post('user/book/order/{id}', [LendingController::class, 'lendingbook'])->name('user.book.order');
Route::get('user/notification', [HomeController::class, 'notification'])->name('user.notification');
Route::get('user/history', [HomeController::class, 'history'])->name('user.history');
Route::post('user/return/{id}', [LendingController::class, 'return'])->name('user.return');
Route::get('user/search', [HomeController::class, 'search'])->name('user.search');