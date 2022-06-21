<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jocs', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('imatge');
            $table->string('num_jug');
            $table->rememberToken();
            $table->timestamps();
            $table->bigInteger('id_sala')->unsigned();
            $table->foreign('id_sala')->references('id')->on('sales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jocs');
    }
};
