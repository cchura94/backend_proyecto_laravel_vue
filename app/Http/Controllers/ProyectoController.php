<?php

namespace App\Http\Controllers;

use App\Models\Informe;
use App\Models\Persona;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit = isset($request->limit)?$request->limit:10;
        $buscar = $request->buscar;
        
        if($buscar){
            
            $proyectos = Proyecto::where("nombre", "like", "%$buscar%")
                                    ->orderBy('id', 'desc')
                                    ->with(['jefe_proyecto', 'tareas', 'recursos', 'informes'])
                                    ->paginate($limit);
            
        }else{

            $proyectos = Proyecto::orderBy('id', 'desc')
                                    ->with(['jefe_proyecto', 'tareas', 'recursos', 'informes'])
                                    ->paginate($limit);
        }
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
        $proyecto->estado = $request->estado;
        // $proyecto->nombre = $request->nombre;
        $proyecto->save();

        return response()->json(["mensaje" => "Proyecto registrado"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $proyecto = Proyecto::with(['jefe_proyecto', 'tareas', 'recursos', 'informes'])
                                ->findOrFail($id);

        return response()->json($proyecto, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "nombre" => "required|string|max:255",
            "descripcion" => "nullable|string",
            "fecha_inicio" => "required|date",
            "fecha_fin" => "required|date|after_or_equal:fecha_inicio",
            'jefe_proyecto' => "required|exists:users,id"
            
        ]);
        
        $proyecto = Proyecto::findOrFail($id);
        $proyecto->nombre = $request->nombre;
        $proyecto->descripcion = $request->descripcion;
        $proyecto->fecha_inicio = $request->fecha_inicio;
        $proyecto->fecha_fin = $request->fecha_fin;
        $proyecto->jefe_proyecto = $request->jefe_proyecto;
        $proyecto->estado = $request->estado;
        // $proyecto->nombre = $request->nombre;
        $proyecto->update();

        return response()->json(["mensaje" => "Proyecto Actualizado"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $proyecto->delete();
        return response()->json(["mensaje" => "Proyecto Eliminado"]);
    }

    public function asignarRecurso($id, Request $request){
        
        $proyecto = Proyecto::find($id);

        // return $request;
        $proyecto->recursos()->attach($request->recurso_id, ["cantidad_asignada" => $request->cantidad_asignada, "responsable_id" => $request->responsable_id, "fecha_asignacion" => date("Y-m-d H:i:s")  ]);

        return response()->json(["mensaje" => "recurso asignado"]);

    }

    public function asignarInforme($id, Request $request){

        $direccion_archivo = "";
        if($file = $request->file('archivo')){
            $direccion_archivo = time() . "-" . $file->getClientOriginalName();
            $file->move("archivos/", $direccion_archivo);

            $direccion_archivo = "archivos/". $direccion_archivo;
            
            $informe = new Informe();
            $informe->proyecto_id = $id;
            $informe->fecha = date("Y-m-d H:i:s");
            $informe->descripcion = $request->descripcion;
            $informe->archivo = $direccion_archivo;
            $informe->save();

            return response()->json(["mensaje" => "Aechivo Registrado"], 201);
        }else{
            return response()->json(["mensaje" => "Es obligatorio el archivo"], 422);

        }
    }
}
