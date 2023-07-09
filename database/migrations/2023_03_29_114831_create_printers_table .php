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
        Schema::create('printers', function (Blueprint $table) {
            $table->id();
            $table->string('ip')->unique();
            $table->string('nome');
            $table->foreignId('marca_id')->constrained('marcas', 'id');
            $table->foreignId('modelo_id')->constrained('modelos', 'id');
            $table->string('matricula')->unique();
            $table->integer('contador_paginas');
        });
    }
    public $timestamps = false;
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('printers');
    }
};
