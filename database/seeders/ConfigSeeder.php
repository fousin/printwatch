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
        'comunity'=>'-c public',
        'version'=>'-v2c'
        ]);
    }
}
