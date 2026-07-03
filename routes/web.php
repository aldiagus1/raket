<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/raket/{raket}', [UserController::class, 'show'])->name('user.show');
    Route::post('/user/raket/{raket}/pdf', [UserController::class, 'downloadPdf'])->name('user.pdf');
    Route::delete('/user/raket/{raket}/beli', [UserController::class, 'beliRaket'])->name('user.beli');
});



Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/raket/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/raket/store', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/raket/{raket}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/raket/{raket}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/raket/{raket}', [AdminController::class, 'destroy'])->name('admin.destroy');
});