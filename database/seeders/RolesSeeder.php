<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'admin' => 'Administrator',
            'member' => 'Member',
        ];

        foreach($roles as $key => $role) {
            Role::create([
                'code' => $key,
                'name' => $role
            ]);
        }
    }
}
