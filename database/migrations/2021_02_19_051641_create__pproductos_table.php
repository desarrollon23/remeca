<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePproductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_pproductos', function (Blueprint $table) {
            $table->id();
            $table->integer('idcate');
            $table->string('descripcion', 100);
            $table->decimal('precio', $precision = 8, $scale = 2);
            $table->integer('cantidad');
            $table->string('visiblecom', 2);
            $table->string('visibleven', 2);
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
        Schema::dropIfExists('_pproductos');
    }
}
