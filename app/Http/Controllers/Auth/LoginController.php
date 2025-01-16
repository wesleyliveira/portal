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
        // Agora a validação será feita automaticamente pelo Form Request
        // Caso o formulário tenha erros, o Laravel irá redirecionar automaticamente com erros de validação

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $request->rememberMe)) {
            return redirect()->route('dashboard');
        }

        // Caso a autenticação falhe
        return Inertia::render('Login', [
            'errors' => ['auth' => 'Credenciais inválidas'],
            'input' => $request->only('email', 'rememberMe'),
        ]);
    }
}