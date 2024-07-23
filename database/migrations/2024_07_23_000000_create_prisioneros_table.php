<?php
// database/migrations/2024_07_23_000000_create_prisioneros_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrisionerosTable extends Migration
{
    public function up()
    {
        Schema::create('prisioneros', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
            $table->string('apellidos');
            $table->date('nacimiento');
            $table->date('ingreso');
            $table->string('delito');
            $table->string('celda');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('prisioneros');
    }
}

?>