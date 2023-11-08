<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
  use HasFactory;

  protected $fillable = [
    'alumno_id',
    'asignatura_id',
    'calificacion',
  ];

  public function alumnos() {
    return $this->belongsTo(Alumno::class, 'alumno_id');
  }

  public function asignaturas() {
    return $this->belongsTo(Asignatura::class, 'asignatura_id');
  }
}
