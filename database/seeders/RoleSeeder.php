<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */ 
    public function run()
    {
        $roles = [
            'Company Admin',
            'Project Manager',
            'Team Leader',
            'Team Members-Employe',
            'HR Personnel'
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
    }
}
