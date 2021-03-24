<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('cedulac', 15);
            $table->string('nombrec', 100);
            $table->string('direccionc', 250)->nullable($value = true);
            $table->string('telefonoc',30)->nullable($value = true);
            $table->string('correoc', 100)->nullable($value = true);
            $table->string('visiblec', 2)->nullable($value = true);
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
        Schema::dropIfExists('clientes');
    }
}
