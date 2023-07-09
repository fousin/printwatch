<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oid extends Model{
    use HasFactory;
    public $timestamps = false;
    
    protected $fillable = [
        'oidTonerPreto',
        'oidTonerCiano',
        'oidTonerMagenta',
        'oidTonerAmarelo',
        'oidTonerMonocromatico',
        'oidTamborImagem',
        'oidUnidadeImagem',
        'oidContadorPagina'
    ];

    public function novoOidMarca($marcaId, Oid $oidBd){
        
        $jaExistOid = $oidBd->firstWhere('marca_id', $marcaId);
        if(!isset($jaExistOid)){            
            $jaExistOid = $oidBd->insert(["marca_id"=>$marcaId]);
        }
        
    }

    public function marca(){
        return $this->belongsTo(Marcas::class);
    }
}

