<?php

namespace Database\Seeders;

use App\Models\ConfigScript;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        ConfigScript::create([
        'comunity'=>'public',
        'version'=>'-v2c',
        'critico'=>11, 
        'emergencia'=>20, 
        'aviso'=>30, 
        'saudavel'=>40,
        ]);
    }
}
