<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AlumnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios=User::role("alumno")->get();
        return view("alumnos", compact("usuarios"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        return   view("maestros", compact("usuario"));
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
