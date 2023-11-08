<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Profesor;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfesorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $profesores = Profesor::with('asignaturas')->get();

      return response()->json($profesores, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $input = $request->all();

      $validator = Validator::make($input, [
        'nombre' => 'required|max:50',
        'apellido' => 'required|max:50',
        'cedula' => 'required|unique:profesors|max_digits:10|numeric',
        'asignatura_id' => 'required|numeric',
      ]);

      if($validator->fails()){
        return response()->json($validator->errors(), 400);
      }

      $profesor = Profesor::create($input);

      return response()->json($profesor, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      try
      {
        $profesor = Profesor::with('asignaturas')
        ->where('id', $id)
        ->firstOrFail();
      }
      catch(ModelNotFoundException $error)
      {
        return response()->json(['error' => 'Profesor no existe o fue eliminado.'], 404);
      }

      return response()->json($profesor, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      try
      {
        $profesor = Profesor::findOrFail($id);
      }
      catch(ModelNotFoundException $error)
      {
        return response()->json(['error' => 'Profesor no existe o fue eliminado.'], 404);
      }

      $input = $request->all();

      $validator = Validator::make($input, [
        'nombre' => 'required|max:50',
        'apellido' => 'required|max:50',
        'cedula' => 'required|max_digits:10|numeric',
        'asignatura_id' => 'required|numeric',
      ]);

      if($validator->fails()){
        return response()->json($validator->errors(), 400);
      }

      $profesor->nombre = $request->nombre;
      $profesor->apellido = $request->apellido;
      $profesor->cedula = $request->cedula;
      $profesor->asignatura_id = $request->asignatura_id;
      $profesor->save();

      return response()->json($profesor, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      try
      {
        $profesor = Profesor::findOrFail($id);
      }
      catch(ModelNotFoundException $error)
      {
        return response()->json(['error' => 'Profesor no existe o fue eliminado.'], 404);
      }

      $profesor->delete();

      return response()->json(['msg' => 'Profesor eliminado.'], 200);
    }
}
