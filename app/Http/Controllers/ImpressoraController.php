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
        $printers = $this->printerBd->with('toners')->get();
        $printers = $this->printerBd->getPrinters(search: $request->get('search', ''));
        $marcas = $this->marcasBd->with('modelos')->get();

        return view('impressoras.index', compact('printers', 'marcas'));
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
