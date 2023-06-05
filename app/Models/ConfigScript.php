<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigScript extends Model{
    use HasFactory;
    public $timestamps = false;
    
    protected $fillable = [
        'comunity',
        'version',
        'critico', 
        'emergencia', 
        'aviso', 
        'saudavel'
    ];
}
