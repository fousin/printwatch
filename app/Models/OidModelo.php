<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OidModelo extends Model{
    use HasFactory;

    protected $fillable = [
        'modelo_id',
        'oidTonerPreto',
        'oidTonerCiano',
        'oidTonerMagenta',
        'oidTonerAmarelo',
        'oidTonerMonocromatico',
        'oidTamborImagem',
        'oidUnidadeImagem',
        'oidContadorPagina'
    ];

    public function novoOidModelo(OidModelo $oidModeloBd, Oid $oidBd, $tipoToner, $marcaId, $modeloId){
        $oidExistente = $oidBd->firstWhere('marca_id', $marcaId);

        $oidNovoModelo=[
            'modelo_id' => $modeloId
        ];

        if(isset($oidExistente)){
            if($tipoToner=="color"){
                $oidNovoModelo += [
                    'oidTonerPreto'=>$oidExistente->oidTonerPreto,
                    'oidTonerCiano'=>$oidExistente->oidTonerCiano,
                    'oidTonerMagenta'=>$oidExistente->oidTonerMagenta,
                    'oidTonerAmarelo'=>$oidExistente->oidTonerAmarelo,
                    'oidTamborImagem'=>$oidExistente->oidTamborImagem,
                ];
            }else{
                $oidNovoModelo += [
                    'oidTonerMonocromatico'=>$oidExistente->oidTonerMonocromatico,
                    'oidUnidadeImagem'=>$oidExistente->oidUnidadeImagem,
                ];
            }
            $oidNovoModelo += ['oidContadorPagina'=>$oidExistente->oidContadorPagina];
        }
        $oidModeloBd->insert($oidNovoModelo);
    }

    public function modelo(){
        return $this->belongsTo(Modelos::class);
    }
}
