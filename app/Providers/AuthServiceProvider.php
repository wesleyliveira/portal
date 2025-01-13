<?php

namespace App\Providers;


use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Sanctum\Sanctum;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Laravel\Sanctum\PersonalAccessToken;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Configuração para usar tokens de acesso pessoal do Sanctum
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);

        // Exemplo de uma autorização (caso precise adicionar mais regras)
        Gate::define('admin', function (User $user) {
            return $user->is_admin; // Defina suas regras de autorização aqui
        });
    
    }
}
