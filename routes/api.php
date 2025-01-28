<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\RecursoController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\UsuarioController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// auth
Route::prefix('/v1/auth')->group(function(){

    Route::post('/login', [AuthController::class, 'funLogin']);
    Route::post('/register', [AuthController::class, 'funRegister']);

    Route::middleware('auth:sanctum')->group(function(){
        Route::get('/profile', [AuthController::class, 'funProfile']);
        Route::post('/logout', [AuthController::class, 'funLogout']);
    });

});


Route::middleware('auth:sanctum')->group(function(){
    // cambios de estado tarea
    
    Route::post("tarea/{id}/actualizar-estado", [TareaController::class, "actualizarEstado"]);
    // generar reporte PDF
    Route::get("proyecto/reportes/pdf", [ProyectoController::class, "funGenerarReportePDF"]);
    Route::get("proyecto/{id}/reportes/pdf", [ProyectoController::class, "funGenerarReporteProyectoPDF"]);
    
    // reporte Excel
    Route:: get("proyecto/reportes/excel", [ProyectoController::class, "funGenerarArchivoExcel"]);
    

    Route::post("proyecto/{id}/asignar-informe", [ProyectoController::class, "asignarInforme"]);

    Route::post("tarea/{id}/asignar-usuario", [TareaController::class, "asignarUsuario"]);
    Route::post("proyecto/{id}/asignar-recurso", [ProyectoController::class, "asignarRecurso"]);
    // CRUD de Usuarios
    Route::apiResource("user", UsuarioController::class);
    Route::apiResource("persona", PersonaController::class);
    Route::apiResource("proyecto", ProyectoController::class);
    Route::apiResource("tarea", TareaController::class);
    Route::apiResource("recurso", RecursoController::class);
});

Route::get("/no-autorizado", function(){
    return response()->json(["message" => "No tiene permisos"]);
})->name("login");