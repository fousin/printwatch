<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tonner extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'cor',
        'capMax',
        'volumeAtual'
    ];
    
    public function printer(){
        return $this->belongsTo(Printer::class);
    }
}
