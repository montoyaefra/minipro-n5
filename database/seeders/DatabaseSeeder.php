<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Curso;
use App\Models\CursoUser;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(3)->create();

        $this->call([RoleSeeder::class]);

        User::create([
            "name" =>"erick",
            "email"=>"erick@erick.com",
            "estado"=> true,
            "direction"=>"no lose",
            "birthday"=>"20 del nomviembre",
            "dni"=>1212346,
            "password"=>bcrypt("admin"),

        ])->assignRole("admin");


        $cantidad=6;
        for ($i= 0 ;$i <$cantidad; $i++){
            User::factory()->create()->assignRole("alumno");
        }    


        for ($i= 0 ;$i <$cantidad; $i++){
            $curso= Curso::factory()->create();
            $maestro= User::factory()->create()->assignRole("maestro");

            DB::table("curso_users")->insert([
                "curso_id"=> $curso->id,
                "user_id"=> $maestro ->id,
            ]);
        }
        

        // $user->assignRole("admin");
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
