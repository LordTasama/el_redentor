<?php
// database/migrations/2024_07_23_000003_create_visitantes_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class CreateVisitantesTable extends Migration
{
    public function up()
    {
        Schema::create('visitantes', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('documento')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('visitantes');
    }
}

?>