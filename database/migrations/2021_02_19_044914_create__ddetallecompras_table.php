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
            $table->Integer('idcompra');
            /* $table->string('fecha', 10)->nullable($value = true);
            $table->string('hora', 10)->nullable($value = true); */
            //$table->unsignedBigInteger('idproducto', 15);
            $table->Integer('idproducto',);
            $table->decimal('cantidadpro', $precision = 8, $scale = 2);
            $table->string('operacion')->nullable($value = true);
            $table->decimal('preciopro', $precision = 8, $scale = 2);
            $table->decimal('totalpro', $precision = 8, $scale = 2);
            //$table->foreign('idcompra')->references('id')->on('_ccompras')->ondelete('cascade');
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
