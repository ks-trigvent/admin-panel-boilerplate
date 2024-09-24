<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Roles;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rolesAvailable = [
            'admin',
            'viewer',
            'editor'
        ];
        foreach ($rolesAvailable as $key => $role) {
            Roles::create([
                'name' => $role
            ]);
        }
    }
}
