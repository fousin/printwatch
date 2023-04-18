<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OidModelo extends Model{
    use HasFactory;

    protected $fillable = [
        'modelo_id',
        'oid01',//cor preto
        'oid02',//cor ciano
        'oid03',//cor magenta
        'oid04',//cor amarelo
        'oid05',//cor monocromático
        'oid06',//tambor de imagem
        'oid07',//unidade de imagem
        'oid08',//capacidade maxima do toner colorido
        'oid09',//capacidade maxima do toner monocromático
    ];

    public function modelo(){
        return $this->belongsTo(Modelos::class);
    }
}
