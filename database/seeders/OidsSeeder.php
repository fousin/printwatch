<?php

namespace Database\Seeders;

use App\Models\Oid;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OidsSeeder extends Seeder
{
    // 'oid01' cor preto
    // 'oid02' cor ciano
    // 'oid03' cor magenta
    // 'oid04' cor amarelo
    // 'oid05' cor monocromático
    // 'oid06' tambor de imagem
    // 'oid07' unidade de imagem
    // 'oid08' capacidade maxima do toner colorido
    // 'oid09' capacidade maxima do toner monocromático
    public function run()
    {
        $oids = [
            [
                'marcas_id' => '1',
                'oid01' => '1.3.6.1.4.1.367.3.2.1.2.24.1.1.5.1',
                'oid02' => '1.3.6.1.4.1.367.3.2.1.2.24.1.1.5.2', 
                'oid03' => '1.3.6.1.4.1.367.3.2.1.2.24.1.1.5.3', 
                'oid04' => '1.3.6.1.4.1.367.3.2.1.2.24.1.1.5.4', 
                'oid05' => null, 
                'oid06' => null, 
                'oid07' => null, 
                'oid08' => null,
                'oid09' => null
            ],
            [
                'marcas_id' => '2',
                'oid01' => null,
                'oid02' => null, 
                'oid03' => null, 
                'oid04' => null, 
                'oid05' => '1.3.6.1.2.1.43.11.1.1.9.1.1', 
                'oid06' => null, 
                'oid07' => null, 
                'oid08' => null,
                'oid09' => '1.3.6.1.2.1.43.11.1.1.8.1.1'
            ],
            [
                'marcas_id' => '3',
                'oid01' => null,
                'oid02' => '1.3.6.1.2.1.43.11.1.1.9.1.1', 
                'oid03' => '1.3.6.1.2.1.43.11.1.1.9.1.2', 
                'oid04' => '1.3.6.1.2.1.43.11.1.1.9.1.3', 
                'oid05' => null, 
                'oid06' => null, 
                'oid07' => null, 
                'oid08' => null,
                'oid09' => '1.3.6.1.2.1.43.11.1.1.8.1.1'
            ],
        ];
        Oid::insert($oids);
    }
}
