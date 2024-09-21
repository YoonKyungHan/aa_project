<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
// AdminLTE Admin Panel


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/data', [UserController::class, 'getData'])->name('admin.users.data');
    Route::get('/admin/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
});

// // 관리자 액세스 시 인증되지 않은 사용자를 로그인 페이지로 리디렉션
// Route::get('/admin', [UserController::class, 'redirectToLogin'])->name('admin.redirectToLogin');
// Route::middleware(['guest'])->group(function () {
//     Route::get('/admin/login', [UserController::class, 'login'])->name('admin.login');
//     Route::post('/admin/login', [UserController::class, 'login']);
// });