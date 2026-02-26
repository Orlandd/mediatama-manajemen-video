<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\VideoRequestController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('User.Home.index');
})->name('home');

Route::get('/admin', function () {
    return view('Admin.Home.home');
})->name('admin.home')->middleware('admin');

// Route::get('/test', function () {
//     return view('welcome');
// })->name('test');



Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->name('logout');

Route::get('/admin/home', function () {
    return view('Admin.Home.home');
})->name('admin.home');

// ==========================================
// Video Routes
// ==========================================
Route::resource('admin/video', VideoController::class)->middleware('admin');
// ==========================================
// User Routes
// ==========================================
Route::get('/admin/user', [UserController::class, 'index'])->name('admin.user.index')->middleware('admin');
Route::get('/admin/user/create', [UserController::class, 'create'])->middleware('admin');
Route::post('/admin/user', [UserController::class, 'store'])->middleware('admin');
Route::get('/admin/user/{id}/edit', [UserController::class, 'edit'])->middleware('admin');
Route::put('/admin/user/{id}', [UserController::class, 'update'])->middleware('admin');
Route::delete('/admin/user/{id}', [UserController::class, 'destroy'])->middleware('admin');

// ==========================================
// Video Request Routes
// ==========================================
Route::get('/video', [VideoController::class, 'userIndex'])->name('video');
Route::post('/video/{id}/request', [VideoController::class, 'userRequest'])->name('video.request');
Route::resource('/admin/video-request', VideoRequestController::class)->only(['index', 'edit', 'update', 'destroy'])->middleware('admin');

// ==========================================
// History Routes
// ==========================================
Route::get('/history', [VideoRequestController::class, 'history'])->name('history');


Route::get('/video/watch/{id}', [VideoController::class, 'watch'])->name('video.watch')->middleware('admin');
Route::get('/video/watch/{id}/user', [VideoController::class, 'userWatch'])->name('user.video.watch');

Route::get('/video/stream/{filename}', [VideoController::class, 'stream'])->name('video.stream');
