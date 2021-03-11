<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIinventarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_iinventario', function (Blueprint $table) {
            $table->id();
            $table->string('fecha', 10);
            $table->string('hora', 10);
            $table->integer('idproducto');
            $table->integer('comprados');
            $table->integer('vendidos');
            $table->integer('existencia');
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
        Schema::dropIfExists('_iinventario');
    }
}
