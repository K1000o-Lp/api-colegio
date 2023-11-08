<?php

use App\Http\Controllers\api\AlumnoController;
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

Route::controller(AlumnoController::class)->group(function(){
  Route::get('/alumnos', 'index');
  Route::post('/alumnos', 'store');
  Route::get('/alumnos/{id}', 'show');
  Route::put('/alumnos/{id}', 'update');
  Route::delete('/alumnos/{id}', 'destroy');
});
