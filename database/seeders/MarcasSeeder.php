<?php

namespace Database\Seeders;

use App\Models\Marcas;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarcasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $marcas = [
            ['marca'=>'ricoh'],
            ['marca'=>'hp'],
            ['marca'=>'samsung'],
        ];
        Marcas::insert($marcas);
    }
}
