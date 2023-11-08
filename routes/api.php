<?php

use App\Http\Controllers\api\AlumnoController;
use App\Http\Controllers\api\AsignaturaController;
use App\Http\Controllers\api\CalificacionController;
use App\Http\Controllers\api\ProfesorController;
use App\Models\Calificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AlumnoController::class)->group(function() {
  Route::get('/alumnos', 'index');
  Route::post('/alumnos', 'store');
  Route::get('/alumnos/{id}', 'show');
  Route::put('/alumnos/{id}', 'update');
  Route::delete('/alumnos/{id}', 'destroy');
});

Route::controller(AsignaturaController::class)->group(function() {
  Route::get('/asignaturas', 'index');
  Route::post('/asignaturas', 'store');
  Route::get('/asignaturas/{id}', 'show');
  Route::put('/asignaturas/{id}', 'update');
  Route::delete('/asignaturas/{id}', 'destroy');
});

Route::controller(ProfesorController::class)->group(function() {
  Route::get('/profesores', 'index');
  Route::post('/profesores', 'store');
  Route::get('/profesores/{id}', 'show');
  Route::put('/profesores/{id}', 'update');
  Route::delete('/profesores/{id}', 'destroy');
});

Route::controller(CalificacionController::class)->group(function() {
  Route::get('/calificaciones', 'index');
  Route::post('/calificaciones', 'store');
  Route::get('/calificaciones/{id}', 'show');
  Route::put('/calificaciones/{id}', 'update');
  Route::delete('/calificaciones/{id}', 'destroy');
});
