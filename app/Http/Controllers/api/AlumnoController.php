<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
      $alumnos = Alumno::all([
        'id',
        'nombre',
        'apellido',
        'cedula',
        'nacimiento',
        'edad',
      ]);

      return response()->json($alumnos, 200);
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
        'cedula' => 'required|unique:alumnos|max_digits:10|numeric',
        'nacimiento' => 'required|date',
        'edad' => 'required|numeric',
      ]);

      if($validator->fails()){
          return response()->json($validator->errors(), 400);
      }

      $alumno = Alumno::create($input);

      return response()->json($alumno, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      try 
      {
        $alumno = Alumno::findOrFail($id);
      } 
      catch(ModelNotFoundException $error) 
      {
        return response()->json(['error' => 'Alumno no existe o fue eliminado'], 404);
      }

      return response()->json($alumno, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      try
      {
        $alumno = Alumno::findOrFail($id);
      }
      catch(ModelNotFoundException $error)
      {
        return response()->json(['error' => 'Alumno no existe o fue eliminado.'], 404);
      }

      $input = $request->all();

      $validator = Validator::make($input, [
        'nombre' => 'required|max:50',
        'apellido' => 'required|max:50',
        'cedula' => 'required|max_digits:10|numeric',
        'nacimiento' => 'required|date',
        'edad' => 'required|numeric',
      ]);

      if($validator->fails()){
          return response()->json($validator->errors(), 400);
      }

      $alumno->nombre = $request->nombre;
      $alumno->apellido = $request->apellido;
      $alumno->cedula = $request->cedula;
      $alumno->nacimiento = $request->nacimiento;
      $alumno->edad = $request->edad;
      $alumno->save();

      return response()->json($alumno, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      try
      {
        $alumno = Alumno::findOrFail($id);
      }
      catch(ModelNotFoundException $error)
      {
        return response()->json(['error' => 'Alumno no existe'], 404);
      }

      $alumno->delete();

      return response()->json(['msg' => 'Alumno eliminado.'], 200);
    }
}
