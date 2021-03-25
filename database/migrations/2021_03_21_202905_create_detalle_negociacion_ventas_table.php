<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleNegociacionVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_negociacion_ventas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('negociacion_id');
            $table->unsignedBigInteger('producto_idn');
            $table->decimal('cantidadprorecmatn', $precision = 8, $scale = 2)->nullable($value = true);
            $table->string('operacionn')->nullable($value = true);
            $table->foreign('negociacion_id')->references('id')->on('negociacion_ventas')->ondelete('cascade');
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
        Schema::dropIfExists('detalle_negociacion_ventas');
    }
}
