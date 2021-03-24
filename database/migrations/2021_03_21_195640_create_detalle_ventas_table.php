<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->id();
            $table->Integer('idventa');
            /* $table->string('fecha', 10)->nullable($value = true);
            $table->string('hora', 10)->nullable($value = true); */
            $table->Integer('idproductov',);
            $table->decimal('cantidadprov', $precision = 8, $scale = 2);
            $table->string('operacionv')->nullable($value = true);
            $table->decimal('precioprov', $precision = 8, $scale = 2);
            $table->decimal('totalprov', $precision = 8, $scale = 2);
            //$table->foreign('idventa')->references('id')->on('ventas')->ondelete('cascade');
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
        Schema::dropIfExists('detalle_ventas');
    }
}
