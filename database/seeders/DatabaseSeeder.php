<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\User::factory()->create([
            'name' => 'Petry Cintra Amaral',
            'position' => 'Gerente',
            'email' => 'petry@regponto.com',
            'password' => '123',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Julie Hevellyn de Oliveira',
            'position' => 'Jornalista-Sênior',
            'email' => 'julie@regponto.com',
            'password' => '123',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Yngra Cintra Amaral',
            'position' => 'Gestao-RH',
            'email' => 'yngra@regponto.com',
            'password' => '123',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Arya De Oliveira',
            'position' => 'Mascote',
            'email' => 'arya@regponto.com',
            'password' => '123',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Neblino Cintra',
            'position' => 'Mascote',
            'email' => 'neblino@regponto.com',
            'password' => '123',
        ]);
    }
}