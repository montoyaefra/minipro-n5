<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\CursoUser;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(15)->create();

        $this->call([RoleSeeder::class]);

        $user =User::create([
            "name" =>"erick",
            "email"=>"erick@erick.com",
            "estado"=> true,
            "direction"=>"no lose",
            "birthday"=>"20 del nomviembre",
            "dni"=>1212346,
            "password"=>bcrypt("admin"),

        ]);


        // $user->assignRole("admin");
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
