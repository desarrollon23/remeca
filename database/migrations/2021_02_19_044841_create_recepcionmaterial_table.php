<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCcomprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_ccompras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idrecepcion');
            $table->string('fecharecepcion', 10)->nullable($value = true);
            $table->string('fechacompra', 10)->nullable($value = true);
            $table->string('hora', 10)->nullable($value = true);
            $table->string('cedula', 15)->nullable($value = true);
            $table->integer('idlugar')->nullable($value = true);
            $table->integer('idestatuspago')->nullable($value = true);
            $table->integer('idtipopago')->nullable($value = true);
            $table->decimal('totalcomra', $precision = 8, $scale = 2)->nullable($value = true);
            $table->decimal('totalpagado', $precision = 8, $scale = 2)->nullable($value = true);
            $table->decimal('diferenciapago', $precision = 8, $scale = 2)->nullable($value = true);
            $table->string('observacionesc', 250)->nullable($value = true);
            $table->foreign('idrecepcion')->references('id')->on('recepcionmaterial')->ondelete('cascade');
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
        Schema::dropIfExists('_ccompras');
    }
}
