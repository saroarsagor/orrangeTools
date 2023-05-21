<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'systemadmin']);
        $role = Role::create(['name' => 'user']);
        $role = Role::create(['name' => 'doctor']);   
        $role = Role::create(['name' => 'patient']);
    }
}
