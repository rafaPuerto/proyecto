<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Falta extends Model
{
    use SoftDeletes;

    public $table = 'faltas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'subgrupo_id',
        'fallo',
        'descipción',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function clases()
    {
        return $this->belongsToMany(Clase::class);
    }
}
