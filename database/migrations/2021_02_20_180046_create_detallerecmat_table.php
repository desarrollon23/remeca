<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallerecmatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detallerecmat', function (Blueprint $table) {
            /* $table->id();
            $table->foreignId('recepcionmaterial_id')->references('id')->on('recepcionmaterial')->onDelete('cascade')->nullable;
            $table->foreignId('producto_id')->references('id')->on('_pproductos')->nullable;
            $table->decimal('cantidadprorecmat', $precision = 8, $scale = 2);
            $table->timestamps(); */
            $table->id();
            $table->unsignedBigInteger('recepcionmaterial_id');
            $table->unsignedBigInteger('producto_id');
            $table->decimal('cantidadprorecmat', $precision = 8, $scale = 2)->nullable($value = true);
            $table->string('operacion')->nullable($value = true);
            $table->foreign('recepcionmaterial_id')->references('id')->on('recepcionmaterial')->ondelete('cascade');
            $table->foreign('producto_id')->references('id')->on('_pproductos')->ondelete('cascade');
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
        Schema::dropIfExists('detallerecmat');
    }
}
