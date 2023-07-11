<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(["name"=>"admin"]);
        $role2 = Role::create(["name"=>"maestro"]);
        $role3 = Role::create(["name"=>"alumno"]);

        Permission::create(["name"=> "ver dashboard"])->syncRoles([$role1, $role2, $role3]);
        
        
    }
}
