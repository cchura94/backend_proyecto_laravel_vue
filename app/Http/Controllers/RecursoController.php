<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recurso;

class RecursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recursos = Recurso::get();

        return response()->json($recursos, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validar
        $request->validate([
            "nombre" => "required",
            "tipo" => "required",
            "stock_disponible" =>"required"

        ]);
        // guardar
        $recurso = new Recurso();
        $recurso->nombre = $request->nombre;
        $recurso->tipo = $request->tipo;
        $recurso->stock_disponible = $request->stock_disponible;
        $recurso->precio = $request->precio;
        $recurso->unidad = $request->unidad;
        $recurso->save();

        //responder
        return response()->json(["mensaje" => "Recurso Registrado"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $recurso = Recurso::findOrFail($id);

        return response()->json($recurso, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        // validar
        $request->validate([
            "nombre" => "required",
            "tipo" => "required",
            "stock_disponible" =>"required"
            
        ]);
        // guardar
        $recurso = Recurso::findOrFail($id);
        $recurso->nombre = $request->nombre;
        $recurso->tipo = $request->tipo;
        $recurso->stock_disponible = $request->stock_disponible;
        $recurso->precio = $request->precio;
        $recurso->unidad = $request->unidad;
        $recurso->save();

        //responder
        return response()->json(["mensaje" => "Recurso Actualizado"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $recurso = Recurso::find($id); 
        // $recurso->delete();

        return response()->json(["mensaje" => "Recurso eliminado"]);
    }
}
