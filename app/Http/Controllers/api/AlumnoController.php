<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Http\Requests\StoreAlumnoRequest;
use App\Http\Requests\UpdateAlumnoRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

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
    public function store(StoreAlumnoRequest $request)
    {
      $alumno = Alumno::create([
        'nombre' => $request->nombre,
        'apellido' => $request->apellido,
        'cedula' => $request->cedula,
        'nacimiento' => $request->nacimiento,
        'edad' => $request->edad,
      ]);
      
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
        return response()->json(['error' => $error], 404);
      }

      return response()->json($alumno, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAlumnoRequest $request, string $id)
    {
      try
      {
        $alumno = Alumno::findOrFail($id);
      }
      catch(ModelNotFoundException $error)
      {
        return response()->json(['error' => $error], 404);
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
        return response()->json(['error' => $error], 404);
      }

      $alumno->delete();

      return response()->json(['msg' => 'Alumno eliminado.'], 200);
    }
}
