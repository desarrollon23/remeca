<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecepcionmaterialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recepcionmaterial', function (Blueprint $table) {
            $table->id();
            $table->string('fecha', 10);
            $table->string('cedula', 15);
            $table->integer('idlugar');
            $table->decimal('pesofull', $precision = 8, $scale = 2);
            $table->decimal('pesovacio', $precision = 8, $scale = 2);
            $table->decimal('pesoneto', $precision = 8, $scale = 2);
            $table->decimal('pesocalculado', $precision = 8, $scale = 2);
            $table->string('observaciones', 250);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recepcionmaterial');
    }
}
