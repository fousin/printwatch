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
            $table->foreignId('marca_id')->constrained('marcas', 'id');
            $table->string('oidTonerPreto')->nullable();//cor preto
            $table->string('oidTonerCiano')->nullable();//cor ciano
            $table->string('oidTonerMagenta')->nullable();//cor magenta
            $table->string('oidTonerAmarelo')->nullable();//cor amarelo
            $table->string('oidTonerMonocromatico')->nullable();//cor monocromático
            $table->string('oidTamborImagem')->nullable();//tambor de imagem
            $table->string('oidUnidadeImagem')->nullable();//unidade de imagem
            $table->string('oidContadorPagina')->nullable();//contador de impressão
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
