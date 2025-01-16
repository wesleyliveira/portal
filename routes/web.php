<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\CheckRole;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Login');
})->name('login');

// Rota POST para login
Route::post('/login', [LoginController::class, 'store'])->name('login.post');

// Rota para dashboard, protegida por autenticação Sanctum
Route::middleware(['auth:sanctum'])->get('/dashboard', function () {
    return inertia('Dashboard');
})->name('dashboard');