<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->string('fechaventa', 10)->nullable($value = true);
            $table->string('horaventa', 10)->nullable($value = true);
            $table->string('cedulav', 15)->nullable($value = true);
            $table->integer('idlugarv')->nullable($value = true);
            $table->integer('idestatuspagov')->nullable($value = true);
            $table->integer('idtipopagov')->nullable($value = true);
            $table->decimal('totalcomrav', $precision = 8, $scale = 2)->nullable($value = true);
            $table->decimal('totalpagadov', $precision = 8, $scale = 2)->nullable($value = true);
            $table->decimal('diferenciapagov', $precision = 8, $scale = 2)->nullable($value = true);
            $table->string('ajusteporpesov', 20)->nullable($value = true);
            $table->string('observacionesv', 250)->nullable($value = true);
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
        Schema::dropIfExists('ventas');
    }
}
