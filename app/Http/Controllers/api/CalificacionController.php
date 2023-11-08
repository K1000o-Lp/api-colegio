<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Calificacion;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CalificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $calificaciones = Calificacion::with('alumnos', 'asignaturas')->get();

      return response()->json($calificaciones, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $input = $request->all();

      $validator = Validator::make($input, [
        'alumno_id' => 'required|numeric',
        'asignatura_id' => 'required|numeric',
        'calificacion' => 'required|numeric|max:20|min:1',
      ]);

      if($validator->fails()){
        return response()->json($validator->errors(), 400);
      }

      $calificacion = Calificacion::create($input);

      return response()->json($calificacion, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      try
      {
        $calificacion = Calificacion::with('alumnos', 'asignaturas')
        ->where('id', $id)
        ->firstOrFail();
      }
      catch(ModelNotFoundException $error)
      {
        return response()->json(['error' => 'Calificación no existe o fue eliminada.'], 404);
      }

      return response()->json($calificacion, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      try
      {
        $calificacion = Calificacion::findOrFail($id);
      }
      catch(ModelNotFoundException $error) 
      {
        return response()->json(['error' => 'Calificación no existe o fue eliminada.'], 404);
      }

      $input = $request->all();

      $validator = Validator::make($input, [
        'alumno_id' => 'required|numeric',
        'asignatura_id' => 'required|numeric',
        'calificacion' => 'required|numeric|max:20|min:1',
      ]);

      if($validator->fails()){
        return response()->json($validator->errors(), 400);
      }

      $calificacion->alumno_id = $request->alumno_id;
      $calificacion->asignatura_id = $request->asignatura_id;
      $calificacion->calificacion = $request->calificacion;
      $calificacion->save();

      return response()->json($calificacion, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      try
      {
        $calificacion = Calificacion::findOrFail($id);
      }
      catch(ModelNotFoundException $error)
      {
        return response()->json(['error' => 'Calificación no existe o fue eliminada.'], 404);
      }

      $calificacion->delete();

      return response()->json(['msg' => 'Calificación eliminada.'], 200);
    }
}
