<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelos extends Model{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'marca_id',
        'modelo',
        'toner',
        'imagem'
    ];


    public function novoModelo(Modelos $modelosBd, $modelo, $toner, $imagem, $marca_id){
        $existe = $modelosBd->firstWhere('modelo', $modelo);

        if(!isset($existe)){
            $modeloCriado = $modelosBd->create([
                "marca_id" => $marca_id, "modelo" => $modelo,"toner"=>$toner,"imagem"=>$imagem
            ]);
            
            $modeloId = $modeloCriado->id;
        }else{
            $modeloId = $existe->id;
        }

        return $modeloId;
       
    }



    public function modelos(){
        return $this->belongsTo(Marcas::class);
    }

    public function oidModelos(){
        return $this->hasOne(OidModelo::class, 'modelo_id', 'id');
    }
    
}
