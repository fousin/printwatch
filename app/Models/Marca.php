<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Marca extends Model{
    use HasFactory;
    public $timestamps = false;
    
    protected $fillable = [
        'marca'
    ];

    public function novaMarca($marca, Marca $marcaBd){
        //verifica se ja existe a marca
        $jaExisteMarca = $marcaBd->firstWhere('marca', $marca);
        if(isset($jaExisteMarca)){
            $marca_id = $jaExisteMarca->id;
        }else{
            $marcaNova = $marcaBd->create($marca);
            $marca_id = $marcaNova->id;
        }

        return $marca_id;
    }


    //relacionamentos

    public function modelos(){
        return $this->hasMany(Modelos::class, 'marca_id', 'id');
    }

    public function oids(){
        return $this->hasOne(Oid::class, 'marca_id', 'id');
    }
}
