<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marcas extends Model{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'marca'
    ];

    
    public function modelos(){
        return $this->hasMany(Modelos::class, 'marcas_id', 'id');
    }

    public function oids(){
        return $this->hasOne(Oid::class, 'marcas_id', 'id');
    }
}
