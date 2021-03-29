<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNegociacionVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('negociacion_ventas', function (Blueprint $table) {
            $table->id(); //QUE NO SEA AUTOINCREMENT
            $table->string('fechan', 10)->nullable($value = true);
            $table->string('cedulan', 15)->nullable($value = true);
            $table->integer('idlugarn')->nullable($value = true);
            $table->integer('idtipopagon',)->nullable($value = true);
            $table->integer('idtipoabonon',)->nullable($value = true);
            $table->string('observaciones', 250)->nullable($value = true);
            $table->string('finalizada', 2)->nullable($value = true);
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
        Schema::dropIfExists('negociacion_ventas');
    }
}
