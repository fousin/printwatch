<?php

namespace Database\Seeders;

use App\Models\Modelos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModelosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modelos = [
            [ 'marcas_id' => '1', 'modelo' => 'c352', 'toner' => 'color', 'imagem' => 'tambor'],
            [ 'marcas_id' => '2', 'modelo' => '408', 'toner' => 'mono', 'imagem' => 'unidade'],
            [ 'marcas_id' => '2', 'modelo' => '532', 'toner' => 'mono', 'imagem' => 'unidade'],
            [ 'marcas_id' => '3', 'modelo' => 'E54321', 'toner' => 'color', 'imagem' => 'unidade'],
        ];

        Modelos::insert($modelos);
    }
}
