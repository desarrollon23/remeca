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
            $table->id(); //QUE NO SEA AUTOINCREMENT
            $table->string('fecha', 10)->nullable($value = true);
            $table->string('cedula', 15)->nullable($value = true);
            $table->integer('idlugar')->nullable($value = true);
            $table->decimal('pesofull', $precision = 8, $scale = 2)->nullable($value = true);
            $table->decimal('pesovacio', $precision = 8, $scale = 2)->nullable($value = true);
            $table->decimal('pesoneto', $precision = 8, $scale = 2)->nullable($value = true);
            $table->decimal('pesocalculado', $precision = 8, $scale = 2)->nullable($value = true);
            $table->string('observaciones', 250)->nullable($value = true);
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
