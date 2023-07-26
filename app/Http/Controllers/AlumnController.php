<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class AlumnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles= Role::all();
        $usuarios=User::role("alumno")->get();
        return view("alumnos", compact("usuarios", "roles"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles= Role::all();
        return  view("alumnos", compact("roles"));
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
        ])->assignRole("alumno");
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
        return   view("alumnos", compact("usuario"));
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
        
        // $usuario = User::find($id);
        $usuario = User::find($id);   // lo mismo q el de arriba
        $usuario->dni= $request->dni;
        $usuario->name= $request->nombre;
        $usuario->email=$request->email;
        $usuario->direction=$request->direccion;
        $usuario->birthday=$request->nacimiento;
        $usuario->save();

        return back();
    }

    /**
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
