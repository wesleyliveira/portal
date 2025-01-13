<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\CheckRole;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', [LoginController::class, 'showLoginForm'])->name('login'); // Rota para o formulário de login

// Rota POST para login
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// Rota para dashboard, protegida por autenticação Sanctum
Route::middleware(['auth:sanctum'])->get('/dashboard', function () {
    return inertia('Dashboard');
})->name('dashboard');