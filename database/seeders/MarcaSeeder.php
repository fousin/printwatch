<?php

namespace Database\Seeders;

use App\Models\Marcas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Marcas::create([
            'marca'=>'ricoh'
        ],
        [
            'marca'=>'hp'
        ],
        [
            'marca'=>'samsung'
        ]
        );
    }
}
