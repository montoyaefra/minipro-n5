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
    // Crear el curso
    Curso::create([
        "nombre" => $request->curso,
    ]);

    // Obtener el ID del maestro seleccionado
    $maestroId = $request->maestro_id;

    if ($maestroId) {
        // Asociar el maestro al curso
        $curso = Curso::latest()->first(); // Obtener el curso recién creado mejorable es linea
        $curso->users()->attach($maestroId);
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
        $curso= Curso::find($id);
        $maestros = User::role('maestro')->get();
        return view('tu_vista_de_edicion', compact('curso', 'maestros'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "curso" => "required",
        ]);    
        
        $curso = Curso::find($id);   
        $curso->nombre = $request->curso;
        $curso->save();
    
        // Obtener el ID del maestro seleccionado
        $maestroId = $request->maestro_id;
    
        if ($maestroId) {
            // Asociar el maestro al curso usando el método sync
            $curso->users()->sync([$maestroId]);
        }
    
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
