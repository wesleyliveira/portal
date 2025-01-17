<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function store(LoginRequest $request)
{
    if (Auth::attempt([
        'email' => $request->email,
        'password' => $request->password
    ], $request->rememberMe)) {
        $request->session()->regenerate(); // Importante para evitar ataques de sessão
        return redirect()->route('dashboard'); // Redireciona ao dashboard
    }

    // Caso falhe, retorna para a página de login com erros
    return Inertia::render('Login', [
        'errors' => ['auth' => 'Credenciais inválidas'],
        'input' => $request->only('email', 'rememberMe'),
    ]);
}
}