<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

include_once __DIR__.'/admin.php'; // Incluir las rutas de admin
include_once __DIR__.'/cda.php'; // Incluir las rutas de admin

Route::get('/', function () {
    return redirect()->route('home');
});

// Auth::routes();

// Rutas de Autenticacion
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('auth.login');
Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
