<?php

namespace Database\Seeders;

use App\Models\Administrador;
use App\Models\Cliente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear un administrador de prueba
        $admin = Administrador::create([
            'nombre' => 'Admin',
            'email' => 'admin@example.com',
            'contrasena' => Hash::make('password'),
            'nivelPermiso' => 'super',
        ]);

        // Crear un cliente de prueba
        Cliente::create([
            'nombre' => 'Cliente',
            'email' => 'cliente@example.com',
            'contrasena' => Hash::make('password'),
            'direccionEnvio' => 'Calle Falsa 123',
            'telefono' => '123456789',
            'administrador_id' => $admin->id,
        ]);
    }
}
