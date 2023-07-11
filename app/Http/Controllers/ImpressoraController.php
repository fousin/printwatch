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
        $printers = $this->printerBd->with('toners')->get();
        //
        $oids = $this->modeloOidBd->get();
        $modelos = $this->modelosBd->get();
        $toners = $this->tonersBd->get();
        //

        //$this->snmpController->atualizaToners($printers, $oids, $modelos, $toners);

        $statusPrinter = array();
        $menorValor = 100;
        foreach($printers as $printer){
            foreach($printer->toners as $toner){
                if($toner->volumeAtual<$menorValor){
                    $menorValor = $toner->volumeAtual;
                }
            }
            if($menorValor>=40){
                $statusPrinter[$printer->nome] = 'success';
            }elseif($menorValor>=30 & $menorValor<40){
                $statusPrinter[$printer->nome] = 'warning';
            }elseif($menorValor>=20 & $menorValor<30){
                $statusPrinter[$printer->nome] = 'danger';
            }elseif($menorValor<=19){
                $statusPrinter[$printer->nome] = 'dark';
            }


        }

        $printers = $this->printerBd->getPrinters(search: $request->get('search', ''));
        $marcas = $this->marcasBd->with('modelos')->get();

        return view('impressoras.index', compact('printers', 'marcas', 'statusPrinter'));
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
        $tipoToner = $this->modelosBd->firstWhere('id', $printer->modelo_id)->toner;

        //cria o toner na tabela
        $this->tonersBd->defineToner($this->tonersBd, $tipoToner, $printer->id);

        return redirect()->route('impressoras.index');
    }

    public function edit($id){
        if(!$printer = $this->printerBd->find($id)){
            return redirect()->route('impressoras.index');
        }
        $marcas = $this->marcasBd->get();

        return view('impressoras.edit', compact('printer', 'marcas'));
    }

    public function update(StoreUpdatePrinterFormRequest $request, $id){
        if(!$printer = $this->printerBd->find($id)){
            return redirect()->route('impressoras.index');
        }
        //todo request passar o id da marca inves o nome
        //todo request passar o id do modelo inves o nome
        $dados = $request->only('nome', 'ip', 'marca', 'modelo', 'matricula');
        $novoTipoToner = $this->modelosBd->where('modelo', $dados['modelo'])->first();

        $novosDados['nome'] = $dados['nome']; 
        $novosDados['ip'] = $dados['ip']; 
        $novosDados['marca_id'] = $this->marcasBd->firstWhere('marca',$dados['marca'])->id;
        $novosDados['modelo_id'] = $this->modelosBd->firstWhere('modelo',$dados['modelo'])->id;
        $novosDados['matricula'] = $dados['matricula']; 

        $printer->update($novosDados);

        $this->tonersBd->atualizaTipoToner($this->tonersBd, $printer->id, $novoTipoToner->toner);
        
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
