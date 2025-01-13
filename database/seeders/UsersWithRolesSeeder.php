<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
class UsersWithRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Pegar os roles existentes
         $normalRole = Role::where('name', 'normal')->first();
         $managerRole = Role::where('name', 'manager')->first();
         $adminRole = Role::where('name', 'admin')->first();
 
         // Criar usuário normal
         User::create([
             'name' => 'Usuário Normal',
             'email' => 'normal@example.com',
             'password' => Hash::make('password'),
             'role_id' => $normalRole->id,
         ]);
 
         // Criar usuário manager
         User::create([
             'name' => 'Usuário Manager',
             'email' => 'manager@example.com',
             'password' => Hash::make('password'),
             'role_id' => $managerRole->id,
         ]);
 
         // Criar usuário admin
         User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'role_id' => $adminRole->id,
        ]);
     }
}

