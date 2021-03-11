<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDdetallecomprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_ddetallecompras', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idcompra');
            $table->string('fecha', 10);
            $table->string('hora', 10);
            $table->string('idproducto', 15);
            $table->decimal('cantidadpro', $precision = 8, $scale = 2);
            $table->decimal('preciopro', $precision = 8, $scale = 2);
            $table->decimal('totalpro', $precision = 8, $scale = 2);
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
        Schema::dropIfExists('_ddetallecompras');
    }
}
