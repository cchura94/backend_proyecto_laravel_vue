<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $personas = Persona::with(['user'])->get();

        return response()->json($personas, 200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "nombres" => "required",
            "user_id" => "required"
        ]);

        $persona = new Persona();
        $persona->nombres = $request->nombres;
        $persona->apellidos = $request->apellidos;
        $persona->ci = $request->ci;
        $persona->fecha_nacimiento = $request->fecha_nacimiento;
        // $persona->estado = $request->estado;
        $persona->user_id = $request->user_id;
        $persona->save();

        return response()->json(["mensaje" => "Persona Registrada"], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $persona = Persona::with(['user'])->find($id);

        return response()->json($persona, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "nombres" => "required",
            "user_id" => "required"
        ]);

        $persona = Persona::find($id);

$       $persona->nombres = $request->nombres;
        $persona->apellidos = $request->apellidos;
        $persona->ci = $request->ci;
        $persona->fecha_nacimiento = $request->fecha_nacimiento;
        $persona->estado = $request->estado;
        $persona->user_id = $request->user_id;
        $persona->update();

        return response()->json(["mensaje" => "Persona Actualizada"], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
