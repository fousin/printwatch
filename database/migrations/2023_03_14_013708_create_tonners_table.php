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
        Schema::create('tonners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('printer_id')->constrained('printers', 'id');
            $table->string('cor');
            $table->integer('capMax');
            $table->integer('volumeAtual');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tonners');
    }
};
