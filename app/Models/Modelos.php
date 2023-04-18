<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelos extends Model{
    use HasFactory;
    public $timestamps = false;
    
    protected $fillable = [
        'marcas_id',
        'modelo',
        'toner',
        'imagem'
    ];

    public function modelos(){
        return $this->belongsTo(Marcas::class);
    }

    public function oidModelos(){
        return $this->hasOne(OidModelo::class, 'modelo_id', 'id');
    }
    
}
