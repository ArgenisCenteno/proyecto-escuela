<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RolesAndUsersSeeder extends Seeder
{
    public function run()
    {
        // Crear roles
        $roles = ['Administrador', 'Director', 'Administrativo'];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        // Crear usuarios
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => bcrypt('1234'),
                'role' => 'Administrador',
            ],
            [
                'name' => 'Director User',
                'email' => 'director@example.com',
                'password' => bcrypt('1234'),
                'role' => 'Director',
            ],
            [
                'name' => 'Administrativo User',
                'email' => 'adminstaff@example.com',
                'password' => bcrypt('1234'),
                'role' => 'Administrativo',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                ['name' => $userData['name'], 'password' => $userData['password']]
            );

            // Asignar rol al usuario
            $user->assignRole($userData['role']);
        }
    }
}
