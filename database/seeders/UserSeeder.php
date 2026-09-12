<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;



class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@yopmail.com',
            'password' => Hash::make('Admin123$'),
        ]);

        $user->assignRole('admin');

        $user = User::create([
            'name' => 'docente',
            'email' => 'docente@yopmail.com',
            'password' => Hash::make('Admin123$'),
        ]);

        $user->assignRole('docente');

        $user = User::create([
            'name' => 'estudiante',
            'email' => 'estudiante@yopmail.com',
            'password' => Hash::make('Admin123$'),
        ]);

        $user->assignRole('estudiante');
    }
}

