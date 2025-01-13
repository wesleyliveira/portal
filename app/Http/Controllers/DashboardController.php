<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Aqui, você passa os dados que você vai usar para decidir o conteúdo da página
        return Inertia::render('Dashboard', [
            'user' => $user,
            'role' => $user->roles()->first()->name // ou o que você usa para pegar a role
        ]);
    }
}
