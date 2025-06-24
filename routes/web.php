<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserDetailController; // Thêm controller mới
use Illuminate\Support\Facades\Route;

// Routes công khai
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/register-application', [HomeController::class, 'registerApplication'])->name('register.application');

// Routes yêu cầu xác thực
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/payment', [PaymentController::class, 'store'])->name('payment.store');
    Route::post('/payment', [PaymentController::class, 'store'])->name('payment.store');
    Route::post('/item/report', [ItemController::class, 'report'])->name('item.report'); // Thêm route mới
    // Routes cho admin
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', [StudentController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/students', [StudentController::class, 'index'])->name('students.index');
        Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
        Route::post('/students', [StudentController::class, 'store'])->name('students.store');
        Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
        Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');
        Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
        
        Route::get('/notifications/create', [NotificationController::class, 'create'])->name('notifications.create');
        Route::post('/notifications', [NotificationController::class, 'send'])->name('notifications.store');
        
        Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
        Route::get('/rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');
        Route::delete('/rooms/{room}', [RoomController::class, 'destroy'])->name('rooms.destroy');
        
        Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');
        Route::delete('/reports/{report}', [ReportController::class, 'destroy'])->name('reports.destroy');
    });

    // Routes cho tất cả người dùng đã đăng nhập (admin và student)
    Route::get('/user-detail', [UserDetailController::class, 'index'])->name('user.detail');
});