<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proyectos = Proyecto::with(['user', 'tareas', 'recursos', 'informes']);
        
        $proyectos = $proyectos->get();
        return response()->json($proyectos, 200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "nombre" => "required|string|max:255",
            "descripcion" => "nullable|string",
            "fecha_inicio" => "required|date",
            "fecha_fin" => "required|date|after_or_equal:fecha_inicio",
            'jefe_proyecto' => "required|exists:users,id"

        ]);
        
        $proyecto = new Proyecto();
        $proyecto->nombre = $request->nombre;
        $proyecto->descripcion = $request->descripcion;
        $proyecto->fecha_inicio = $request->fecha_inicio;
        $proyecto->fecha_fin = $request->fecha_fin;
        $proyecto->jefe_proyecto = $request->jefe_proyecto;
        // $proyecto->nombre = $request->nombre;
        // $proyecto->nombre = $request->nombre;
        $proyecto->save();

        return response()->json(["mensaje" => "Proyecto registrado"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
