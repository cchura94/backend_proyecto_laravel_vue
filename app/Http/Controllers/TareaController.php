<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "nombre" => "required",
            "fecha_inicio" => "required",
            "fecha_fin" => "required",
            "estado" => "required",
            "prioridad" => "required",
            "proyecto_id" => "required"
        ]);

        $tarea = new Tarea();
        $tarea->nombre = $request->nombre;
        $tarea->descripcion = $request->descripcion;
        $tarea->fecha_inicio = $request->fecha_inicio;
        $tarea->fecha_fin = $request->fecha_fin;
        $tarea->estado = $request->estado;
        $tarea->prioridad = $request->prioridad;
        $tarea->proyecto_id = $request->proyecto_id;
        // $tarea->porcentaje_avance = $request->porcentaje_avance;
        $tarea->save();

        return response()->json(["mensaje" => "Tarea Registrada"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tarea = Tarea::with(['users', 'proyecto'])->findOrFail($id);
        return response()->json($tarea, 200);
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

    public function asignarUsuario($id, Request $request){
        $tarea = Tarea::find($id);
        $tarea->users()->attach($request->user_id);

        return response()->json(["mensaje" => "Usuario Asignado a la Tarea"], 201);
    }
}
