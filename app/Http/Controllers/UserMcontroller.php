<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserMcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles= Role::all();
        $usuarios= User::role("maestro")->get();
        return view("maestros", compact("usuarios", "roles"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles= Role::all();
        return  view("maestros", compact("roles"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' =>'required',
            'email' => ['required','email']
        ]);

        if($validator->fails()){
            return back();
        }

        User::create([
            "dni"=> $request->dni,
            "name"=> $request->nombre,
            "email"=> request('email'),
            "direction"=> $request->direccion,
            "password"=> Hash::make($request->pass),
            "birthday"=>$request->nacimiento,
            "estado" =>$request->estado
        ])->assignRole($request->rol);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $usuario= User::find($id); 
        $roles= Role::all();
        return   view("maestros", compact("usuario", "roles"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "nombre" => "required",
            "email"=> ["required", "email"]
        ]);    
        
        //paso 1 leer el error
        $newRol = $request->rol;
        // Paso 2  traer todos los roles
        $rolesDB= Role::all();
        $rolesNames = [];

        // guardo los nombres de los roles en arreglo
        foreach ($rolesDB as $roleDB){
            $rolesNames[]= $roleDB->name;
        }
        // paso 4 compruebo que el q he recibo existen en arreglo de roles
        $rolExits= in_array($newRol, $rolesNames, true);

        // $usuario = User::find($id);
        $usuario = User::find($id);   // lo mismo q el de arriba
        $usuario->name= $request->nombre;
        $usuario->email=$request->email;
        $usuario->direction=$request->direccion;
        $usuario->birthday=$request->nacimiento;
        $usuario->save();    

        if($rolExits){
            //remover los roles existen en el usuario
            foreach ($rolesNames as $rol){
                $usuario->removeRole($rol);

                $usuario->assignRole($newRol);
            }
        } else {
            return back();
        }
        return back();
    }

    /**s
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usuario = User::find($id);
            
        if ($usuario) {
            $usuario= User::destroy($id);
            return back();
        } else {
            return back();
        }
    }
}
