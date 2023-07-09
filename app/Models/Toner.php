<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Toner extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $tonersBd;

    public function __construct(Toner $toner){
        $this->tonersBd = $toner;
    }

    protected $fillable = [
        'printer_id',
        'cor',
        'volumeAtual'
    ];
    
    public function printer(){
        return $this->belongsTo(Printer::class);
    }

    public function defineToner($tipo, $printeId){     
        if($tipo=='mono'){
            $toner = ["printer_id"=>$printeId,"cor"=>"monocromatico", "volumeAtual"=>0];
            //insert
            $this->tonersBd->insert($toner);

        }else{
            $toner = [
                ["printer_id"=>$printeId,"cor"=>"preto", "volumeAtual"=>0],
                ["printer_id"=>$printeId,"cor"=>"ciano", "volumeAtual"=>0],
                ["printer_id"=>$printeId,"cor"=>"magenta", "volumeAtual"=>0],
                ["printer_id"=>$printeId,"cor"=>"amarelo", "volumeAtual"=>0]
        ];         
            //todo insert
            $this->tonersBd->insert($toner);
        }
    }

    public function atualizaTipoToner($printerId, $novoTipo){
        //encontra todos os toners coloridos da impressora
        $toners = $this->tonersBd->where("printer_id", $printerId)->get();
        foreach ($toners as $toner) {
            $toner->delete();
        }

        $this->defineToner($printerId, $novoTipo);

    }
}
