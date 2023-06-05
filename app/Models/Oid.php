<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oid extends Model{
    use HasFactory;
    public $timestamps = false;

    
    protected $fillable = [
        'oid01',//cor preto
        'oid02',//cor ciano
        'oid03',//cor magenta
        'oid04',//cor amarelo
        'oid05',//cor monocromático
        'oid06',//tambor de imagem
        'oid07',//unidade de imagem
        'oid08',//capacidade maxima do toner colorido
        'oid09',//capacidade maxima do toner monocromático
        'oid10',//capacidade maxima do tambor
        'oid11',//capacidade maxima da unidade
        'oid12',//contador de impressão
    ];

    public function marca(){
        return $this->belongsTo(Marcas::class);
    }
}
