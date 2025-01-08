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
        $usuarios = User::get();

        return response()->json($usuarios, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $nombre = $request->name;
        $correo = $request->email;
        $clave = bcrypt($request->password);
        // guardar
        DB::insert("insert into users (name, email, password) values (?, ?, ?)", [$nombre, $correo, $clave]);

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
