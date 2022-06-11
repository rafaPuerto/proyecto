<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subgrupo extends Model
{
    use SoftDeletes;

    public $table = 'subgrupo';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'grupo_id',
        'orden',
        'suborden',
        'subgrupo',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
