<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePrinterFormRequest;
use App\Models\ConfigScript;
use App\Models\Marca;
use App\Models\Modelos;
use App\Models\OidModelo;
use App\Models\Printer;
use App\Models\Toner;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\Stub\ReturnArgument;
use Symfony\Component\Process\Process;

class ImpressoraController extends Controller{
    protected $printerBd;
    protected $marcasBd;
    protected $tonersBd;
    protected $modelosBd;
    protected $modeloOidBd;
    protected $snmpController;
    protected $configs;
    
    public function __construct(
        Printer $printer, 
        Toner $toner, 
        Marca $marcas, 
        Modelos $modelos, 
        OidModelo $modeloOidBd, 
        SnmpController $snmp, 
        ConfigScript $configs){

        $this->modeloOidBd = $modeloOidBd;
        $this->printerBd = $printer;
        $this->marcasBd = $marcas;
        $this->tonersBd = $toner;
        $this->modelosBd = $modelos;
        $this->snmpController = $snmp;
        $this->configs = $configs;
    }
   

    public function index(Request $request){
        
        $marcas = $this->marcasBd->with('modelos')->get();
        $printers = $this->printerBd->with('toners')->get();
        $printers = $this->printerBd->getPrinters(search: $request->get('search', ''));
        $styles = array();
        $estiloClasse = '';
        $saudavel = $this->configs->pluck('saudavel')[0];
        $aviso = $this->configs->pluck('aviso')[0];
        $emergencia = $this->configs->pluck('emergencia')[0];
        $critico = $this->configs->pluck('critico')[0];
        
        foreach($printers as $printer){
            $tipoToner = $this->modelosBd->firstWhere('modelo',$printer->modelo)->toner;
            $tonersValores = $this->snmpController->getTonersValue($printer->id);
            $valores = array();
            
            if($tipoToner=='mono'){
                $volumeAtual = $tonersValores[0]*100/$tonersValores[1];
                $valores = ["capMax"=>$tonersValores[1], "volumeAtual"=>$volumeAtual];
                $this->tonersBd->where("printer_id", $printer->id)->update($valores);

                if ($volumeAtual >= 35) {
                    $estiloClasse = "btn-success";
                } elseif ($volumeAtual<35 && $volumeAtual>=25) {
                    $estiloClasse = "btn-warning";
                } elseif ($volumeAtual<25 && $volumeAtual>=15) {
                    $estiloClasse = "btn-danger";
                } elseif ($volumeAtual<=10) {
                    $estiloClasse = "btn-dark";
                }

                $styles[$printer->nome] = $estiloClasse;

            }else{
                //transforma os valores em porcentagem
                foreach ($tonersValores as $tonerValor){
                    if(isset($tonersValores[4])){
                        $volumeAtual = $tonerValor*100/$tonersValores[4];
                    }else{
                        $volumeAtual = $tonerValor;
                    }
                    array_push($valores, $volumeAtual);   
                }

                //encontra todos os toners coloridos da impressora
                $toners = $this->tonersBd->where("printer_id", $printer->id)->get();
        
                foreach($toners as $key => $toner){
                    
                    if(isset($tonersValores[4])){
                        $valorToner = ["capMax" => $tonersValores[4], "volumeAtual" => $valores[$key]];
                    }else{
                        $valorToner = ["capMax" => 100, "volumeAtual" => $valores[$key]];
                    }
                        
                    //atualiza
                    $this->tonersBd->where("id", $toner->id)->where("printer_id", $printer->id)->update($valorToner);


                    if (min($valores) >= 40) {
                        $estiloClasse = "btn-success";
                    } else{
                        if (min($valores)<40 && min($valores)>=30) {
                            $estiloClasse = "btn-warning";
                        }else{
                            if (min($valores)<30 && min($valores)>=20 ) {
                                $estiloClasse = "btn-danger";
                            }elseif (min($valores)>=0 && min($valores)<20 )   {
                                $estiloClasse = "btn-dark";
                            }
                        }
                    }
                     
                    $styles[$printer->nome] = $estiloClasse;
                }
            }
        }
        return view('impressoras.index', compact('printers', 'marcas', 'styles'));
    }
    
    public function show($id){
        if(!$printer = $this->printerBd->find($id)){
            return redirect()->route('impressoras.index');
        }
        return view('impressoras.show', compact('printer'));
    }

    public function create(){
        $marcas = $this->marcasBd->with('modelos')->get();
        $modelos = $this->modelosBd->get()->all();
        return view('impressoras.create', compact('marcas', 'modelos'));
    } 

    public function store(StoreUpdatePrinterFormRequest $request){
        $data = $request->only([
            'nome', 'ip', 'marca', 'modelo', 'matricula', 
        ]);
        
        $data['contador_paginas'] = 0;
        
        //recupera o id da marca selecionada
        $marca = $this->marcasBd->firstWhere('marca', $data['marca']);
        $data['marca_id'] = $marca->id;
        unset($data['marca']);

        //recupera o id do modelo selecionado
        $modelo = $this->modelosBd->firstWhere('modelo', $data['modelo']);
        $data['modelo_id'] = $modelo->id;
        unset($data['modelo']);
        //cria a impressora
        $printer = $this->printerBd->create($data);
        
        //recupera o tipo do toner
        $tipoToner = $this->modelosBd->where('modelo', '=', $printer->modelo)->first();
        
        //cria o toner na tabela
        $this->tonersBd->defineToner($this->tonersBd, $tipoToner, $printer->id);

        return redirect()->route('impressoras.index');
    }

    public function edit($id){
        $marcas = $this->marcasBd->get();
        if(!$printer = $this->printerBd->find($id)){
            return redirect()->route('impressoras.index');
        }
        return view('impressoras.edit', compact('printer', 'marcas'));
    }

    public function update(StoreUpdatePrinterFormRequest $request, $id){
        if(!$printer = $this->printerBd->find($id)){
            return redirect()->route('impressoras.index');
        }
        $printer->update($request->all());
        
        $novoTipoToner = $this->modelosBd->where('modelo', '=', $printer->modelo)->first();

        $this->tonersBd->atualizaTipoToner($this->tonersBd, $printer->id, $novoTipoToner);

        return redirect()->route('impressoras.index');
    }

    public function delete($id){
        if(!$printer = $this->printerBd->find($id)){
            return redirect()->route('impressoras.index');
        }
        //remove os toners antes de deletar a impressora
        $toners = $this->tonersBd->where('printer_id', $id)->get();
        foreach ($toners as $toner) {
            $toner->delete();
        }
        
        $printer->delete();
        return redirect()->route('impressoras.index');
    }

}
