<?php
// database/migrations/2024_07_23_000004_create_visitas_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitasTable extends Migration
{
    public function up()
    {
        Schema::create('visitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visitante_id')->constrained('visitantes');
            $table->foreignId('prisionero_id')->constrained('prisioneros');
            $table->dateTime('inicioVisita')->format('Y-m-d'); 
            $table->dateTime('finVisita')->format('Y-m-d'); 
          

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('visitas');
    }
}


?>