<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Toner extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'printer_id',
        'cor',
        'volumeAtual'
    ];
    
    public function printer(){
        return $this->belongsTo(Printer::class);
    }

    public function defineToner(Toner $tonerBd, $tipo, $printeId){     

        if($tipo=='mono'){
            $toner = [
                ["printer_id"=>$printeId, "cor"=>"monocromatico", "volumeAtual"=>0],
                ["printer_id"=>$printeId, "cor"=>"unidade", "volumeAtual"=>0]
            ];
        }else{
            $toner = [
                ["cor"=>"preto", "printer_id"=>$printeId, "volumeAtual"=>0],
                ["cor"=>"ciano", "printer_id"=>$printeId, "volumeAtual"=>0],
                ["cor"=>"magenta", "printer_id"=>$printeId, "volumeAtual"=>0],
                ["cor"=>"amarelo", "printer_id"=>$printeId, "volumeAtual"=>0]
            ];         
        }

        //todo insert
        $tonerBd->insert($toner);
        
        
    }

    public function atualizaTipoToner(Toner $tonerBd, $printerId, $novoTipo){
        //encontra todos os toners coloridos da impressora
        $toners = $tonerBd->where("printer_id", $printerId)->get();
        foreach ($toners as $toner) {
            $toner->delete();
        }
        $this->defineToner($tonerBd, $novoTipo, $printerId);
        
    }
}
