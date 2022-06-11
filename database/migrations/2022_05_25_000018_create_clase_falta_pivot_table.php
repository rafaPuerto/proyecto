<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClaseFaltaPivotTable extends Migration
{
    public function up()
    {
        Schema::create('clase_falta', function (Blueprint $table) {
            $table->unsignedInteger('falta_id');

            $table->foreign('falta_id', 'falta_id_fk')->references('id')->on('faltas');

            $table->unsignedInteger('clase_id');

            $table->foreign('clase_id', 'clase_id_fk')->references('id')->on('clases');
        });
    }
}
