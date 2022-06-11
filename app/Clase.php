<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clase extends Model
{
    use SoftDeletes;

    public $table = 'clases';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'instructor_id',
        'alumno_id',
        'hora_inicio',
        'hora_final',
        'recorrido',
        'comentarios',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function faltas()
    {
        return $this->belongsToMany(Falta::class, 'clase_falta', 'clase_id', 'falta_id');
    }
}