<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User; // Adicionando a importação da model User
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;


class LoginController extends Controller
{
    // Método para exibir o formulário de login
    public function showLoginForm()
    {
        return inertia('Login');
    }

    // Método para autenticar o usuário
    public function login(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'Por favor, insira um e-mail válido.',
            'password.required' => 'O campo senha é obrigatório.',
        ]);

        // Tentando autenticar o usuário
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->rememberMe)) {
            // Autenticado com sucesso, redireciona para o dashboard
            return redirect()->route('dashboard');
        }

        // Sem lançar a exceção, redireciona de volta com a mensagem de erro
        return redirect()->route('login')
            ->withErrors(['email' => 'As credenciais fornecidas são inválidas.'])
            ->withInput();  // Passa os dados do formulário de volta
    }
}