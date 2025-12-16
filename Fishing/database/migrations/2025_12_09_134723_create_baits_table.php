<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Leurre', function (Blueprint $table) {
            $table->integer('Id')->primary();
            $table->string('nom');
            $table->text('descriptif')->nullable();
            $table->decimal('prix', 8, 2);
            $table->string('nomImg')->nullable();
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
        Schema::dropIfExists('Leurre');
    }
}
