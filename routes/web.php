<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemPenjualanController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

// Redirect root URL (/) langsung ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

// Route yang hanya bisa diakses oleh GUEST (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
});

// Route penanganan POST login
Route::post('/auth', [AuthController::class, 'auth'])->name('auth');

// Route yang hanya bisa diakses setelah AUTH (sudah login)
Route::middleware('auth')->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Route Profile User
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Route Admin & Kasir (Sudah diubah agar Kasir bisa mengakses manajemen User)
    Route::middleware('role:admin,kasir')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
        
        // Menerima PUT dan POST agar terhindar dari MethodNotAllowed error
        Route::match(['PUT', 'POST'], '/users/update/{user}', [UserController::class, 'update'])->name('users.update');
        
        // Route Delete User
        Route::delete('/users/destroy/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    // Route Khusus Admin & Kasir
    Route::middleware('role:admin,kasir')->group(function () {
        Route::resource('/produk', ProdukController::class);
        Route::resource('/penjualan', PenjualanController::class);
        Route::resource('/itempenjualan', ItemPenjualanController::class);
    });

});