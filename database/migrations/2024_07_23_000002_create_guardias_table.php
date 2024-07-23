<?php
// database/migrations/2024_07_23_000002_create_guardias_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuardiasTable extends Migration
{
    public function up()
    {
        Schema::create('guardias', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
            $table->string('apellidos');
            $table->dateTime('ultimaSesion');
            $table->string('rol');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('guardias');
    }
}








?>