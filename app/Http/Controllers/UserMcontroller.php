<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Curso;
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
        $cursos= Curso::all();
        return view("maestros", compact("usuarios", "cursos", "roles"));
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
        'nombre' => 'required',
        'email' => ['required', 'email'],
        'curso_id' => 'nullable|exists:cursos,id' // Validar que el curso_id exista en la tabla cursos
    ]);

    if ($validator->fails()) {
        return back();
    }

    $userData = [
        "dni" => $request->dni,
        "name" => $request->nombre,
        "email" => $request->email,
        "direction" => $request->direccion,
        "password" => Hash::make($request->pass),
        "birthday" => $request->nacimiento,
        "estado" => $request->estado
    ];

    $user = User::create($userData)->assignRole("maestro");

    // Si se seleccionó un curso válido, asignarlo al usuario
    if ($request->curso_id) {
        $curso = Curso::findOrFail($request->curso_id);
        $user->cursos()->attach($curso);
    }

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
        $cursos= Curso::all();
        return   view("maestros", compact("usuario", "roles", "cursos"));
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
        $usuario = User::find($id); 
        $usuario->name= $request->nombre;
        $usuario->email=$request->email;
        $usuario->direction=$request->direccion;
        $usuario->birthday=$request->nacimiento;
        $usuario->save();    

        if ($request->has('curso_id')) {
            $cursoId = $request->curso_id;
    
            $usuario->cursos()->sync([$cursoId]);
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
