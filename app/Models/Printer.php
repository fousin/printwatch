<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Printer extends Authenticatable{
    use HasApiTokens, HasFactory, Notifiable;
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ip',
        'nome',
        'marca_id',
        'modelo_id',
        'matricula',
        'contador_paginas'
    ];
    
    public function getPrinters(string|null $search = ''){
        $printers = $this->where(function ($query) use ($search){
            if($search){
                $query->where('nome','LIKE', "%{$search}%");
                $query->orWhere('ip','LIKE', "%{$search}%");
                $query->orWhere('matricula','LIKE', "%{$search}%");
            }
        })->get();

        return $printers;
    }


    
    // relacionamentos 
    public function toners(){
        return $this->hasMany(Toner::class, 'printer_id', 'id');
    }

    public function marcas(){
        return $this->hasOne(Marcas::class, 'marca_id', 'id');
    }

    public function modelos(){
        return $this->hasOne(Modelos::class, 'modelo_id', 'id');
    }
    
}

