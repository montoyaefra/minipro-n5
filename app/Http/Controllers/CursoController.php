<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $users = User::role("maestro")->get();
        // $users[0]->cursos;
        return view("clases", compact("users"));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cursos= Curso::all();
        return  view("clases", compact("cursos"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Curso::create([
            "nombre"=> $request->curso,
        ]);
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
        $curso= Curso::find($id); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "curso" => "required",
        ]);    
        
        // $usuario = User::find($id);
        $curso = Curso::find($id);   // lo mismo q el de arriba
        $curso->nombre= $request->curso;
        $curso->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $curso = Curso::find($id);
            
        if ($curso) {
            $curso= Curso::destroy($id);
            return back();
        } else {
            return back();
        }
    }
}
