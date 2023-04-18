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
        Schema::create('oids', function (Blueprint $table) {
            $table->id();
            $table->foreignId('marcas_id')->constrained('marcas', 'id');
            $table->string('oid01')->nullable();//cor preto
            $table->string('oid02')->nullable();//cor ciano
            $table->string('oid03')->nullable();//cor magenta
            $table->string('oid04')->nullable();//cor amarelo
            $table->string('oid05')->nullable();//cor monocromático
            $table->string('oid06')->nullable();//tambor de imagem
            $table->string('oid07')->nullable();//unidade de imagem
            $table->string('oid08')->nullable();//capacidade maxima do toner colorido
            $table->string('oid09')->nullable();//capacidade maxima do toner monocromático
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oids');
    }
};
