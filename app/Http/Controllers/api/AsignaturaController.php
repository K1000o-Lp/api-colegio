<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Asignatura;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AsignaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $asignaturas = Asignatura::all([
        'id',
        'nombre',
        'descripcion'
      ]);

      return response()->json($asignaturas, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $input = $request->all();

      $validator = Validator::make($input, [
        'nombre' => 'required|max:50',
        'descripcion' => 'nullable',
      ]);

      if($validator->fails()){
          return response()->json($validator->errors(), 400);
      }

      $asignatura = Asignatura::create($input);

      return response()->json($asignatura, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      try
      {
        $asignatura = Asignatura::findOrFail($id);
      }
      catch(ModelNotFoundException $error)
      {
        return response()->json(['error' => $error], 404);
      }

      return response()->json($asignatura);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      try
      {
        $asignatura = Asignatura::findOrFail($id);
      }
      catch(ModelNotFoundException $error)
      {
        return response()->json(['error' => 'Asignatura no existe o fue eliminada.'], 404);
      }

      $input = $request->all();

      $validator = Validator::make($input, [
        'nombre' => 'required|max:50',
        'descripcion' => 'nullable',
      ]);

      if($validator->fails()){
          return response()->json($validator->errors(), 400);
      }

      $asignatura->nombre = $request->nombre;
      $asignatura->descripcion =$request->descripcion;
      $asignatura->save();

      return response()->json($asignatura, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      try
      {
        $asignatura = Asignatura::findOrFail($id);
      }
      catch(ModelNotFoundException $error)
      {
        return response()->json(['error' => 'Asignatura no existe.'], 404);
      }

      $asignatura->delete();

      return response()->json(['msg' => 'Asignatura Eliminada'], 200);
    }
}
