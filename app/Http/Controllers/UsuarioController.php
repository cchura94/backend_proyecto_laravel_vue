<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // listar
        // $usuarios = DB::select("select * from users");
        $usuarios = User::with(['persona', 'proyectos', 'tareas'])->get();

        return response()->json($usuarios, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|max:30|min:2",
            "email" => "required|email|unique:users",
            "password" => "required"
        ]);

        $nombre = $request->name;
        $correo = $request->email;
        $clave = bcrypt($request->password);
        // guardar
        // DB::insert("insert into users (name, email, password) values (?, ?, ?)", [$nombre, $correo, $clave]);
        $usuario = new User();
        $usuario->name = $nombre;
        $usuario->email = $correo;
        $usuario->password = $clave;
        $usuario->save();

        return response()->json(["mensaje" => "Usuario Registrado"], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $usuario = User::findOrFail($id);
        return response()->json($usuario, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $usuario = User::findOrFail($id);

        $request->validate([
            "name" => "required|max:30|min:2",
            "email" => "required|email|unique:users,email,".$id,
            "password" => "string"
        ]);

        $nombre = $request->name;
        $correo = $request->email;

        // modifica
    
        $usuario->name = $nombre;
        $usuario->email = $correo;
        if(isset($request->password)){
            $usuario->password = bcrypt($request->password);
        }
        $usuario->update();

        return response()->json(["mensaje" => "Usuario Actualizado"], 201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();
        
        return response()->json(["mensaje" => "Usuario Eliminado"], 200);

    }
}
