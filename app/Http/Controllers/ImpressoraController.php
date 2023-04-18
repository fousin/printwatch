<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePrinterFormRequest;
use App\Models\ConfigScript;
use App\Models\Marcas;
use App\Models\Modelos;
use App\Models\OidModelo;
use App\Models\Printer;
use App\Models\Tonner;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\Stub\ReturnArgument;
use Symfony\Component\Process\Process;

class ImpressoraController extends Controller{
    protected $printerBd;
    protected $marcasBd;
    protected $tonnersBd;
    protected $modelosBd;
    protected $modeloOidBd;
    protected $snmpController;
    protected $configs;
    
    public function __construct(Printer $printer, Tonner $tonner, Marcas $marcas, Modelos $modelos, OidModelo $modeloOidBd, SnmpController $snmp, ConfigScript $configs){
        $this->modeloOidBd = $modeloOidBd;
        $this->printerBd = $printer;
        $this->marcasBd = $marcas;
        $this->tonnersBd = $tonner;
        $this->modelosBd = $modelos;
        $this->snmpController = $snmp;
        $this->configs = $configs;
    }

    public function index(Request $request){
        $marcas = $this->marcasBd->with('modelos')->get();
        $printers = $this->printerBd->with('tonners')->get();
        $printers = $this->printerBd->getPrinters(search: $request->get('search', ''));
        $styles = array();
        $estiloClasse = '';
        
        foreach($printers as $printer){
            $tipoToner = $this->modelosBd->firstWhere('modelo',$printer->modelo)->toner;
            $tonersValores = $this->snmpController->getTonersValue($printer->id);
            $valores = array();
            
            if($tipoToner=='mono'){
                $volumeAtual = $tonersValores[0]*100/$tonersValores[1];
                $valores = ["capMax"=>$tonersValores[1], "volumeAtual"=>$volumeAtual];
                $this->tonnersBd->where("printer_id", $printer->id)->update($valores);
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
                $toners = $this->tonnersBd->where("printer_id", $printer->id)->get();
        
                foreach($toners as $key => $toner){
                    
                    if(isset($tonersValores[4])){
                        $valorToner = ["capMax" => $tonersValores[4], "volumeAtual" => $valores[$key]];
                    }else{
                        $valorToner = ["capMax" => 100, "volumeAtual" => $valores[$key]];
                    }
                    //atualiza
                    $this->tonnersBd->where("id", $toner->id)->where("printer_id", $printer->id)->update($valorToner);
                    
                    if(min($valores)>=40){
                        $estiloClasse = 'btn-success';
                    }else{
                        if(min($valores)>=30 && min($valores)<=40){
                            $estiloClasse = 'btn-warning';
                        }else{
                            if(min($valores)>=20 && min($valores)<=30){
                                $estiloClasse = 'btn-danger';
                            }else{
                                $estiloClasse = 'btn-dark';
                            }  
                        }
                    }
                    $styles[$printer->name] = $estiloClasse;
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
            'name', 'ip', 'marca', 'modelo', 'matricula', 
        ]);
        
        $printer = $this->printerBd->create($data);

        $tipoToner = $this->modelosBd->where('modelo', '=', $printer->modelo)->first();

        // Criando os registros na tabela "tonners"
        if($tipoToner->toner=='color'){   
            $tonnersData = [
                ['cor' => 'Preto', 'capMax' => 100, 'volumeAtual' => 100, 'printer_id' => $printer->id],
                ['cor' => 'Ciano', 'capMax' => 100, 'volumeAtual' => 100, 'printer_id' => $printer->id],
                ['cor' => 'Magenta', 'capMax' => 100, 'volumeAtual' => 100, 'printer_id' => $printer->id],
                ['cor' => 'Amarelo', 'capMax' => 100, 'volumeAtual' => 100, 'printer_id' => $printer->id],
            ];
            $this->tonnersBd->insert($tonnersData);
        }else{
            // Criando os registros na tabela "tonners"
            if($tipoToner->toner=='mono'){   
                $tonnersData = [
                    ['cor' => 'Monocormatico', 'capMax' => 15000, 'volumeAtual' => 15000, 'printer_id' => $printer->id],
                ];
                $this->tonnersBd->insert($tonnersData);
            }
        }
        
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
        
        //remove os tonners antes de deletar a impressora
        $tonners = $this->tonnersBd->where('printer_id', $id)->get();
        foreach ($tonners as $tonner) {
            $tonner->delete();
        }

        $tipoToner = $this->modelosBd->where('modelo', '=', $printer->modelo)->first();

        //novos tonners
        // Criando os registros na tabela "tonners"
        if($tipoToner->toner=='color'){
            $tonnersData = [
                ['cor' => 'Preto', 'capMax' => 100, 'volumeAtual' => 100, 'printer_id' => $printer->id],
                ['cor' => 'Ciano', 'capMax' => 100, 'volumeAtual' => 100, 'printer_id' => $printer->id],
                ['cor' => 'Magenta', 'capMax' => 100, 'volumeAtual' => 100, 'printer_id' => $printer->id],
                ['cor' => 'Amarelo', 'capMax' => 100, 'volumeAtual' => 100, 'printer_id' => $printer->id],
            ];
            $this->tonnersBd->insert($tonnersData);
        }else{
            // Criando os registros na tabela "tonners"
            if($tipoToner->toner=='mono'){
                $tonnersData = [
                    ['cor' => 'Monocormatico', 'capMax' => 15000, 'volumeAtual' => 15000, 'printer_id' => $printer->id],
                ];
                $this->tonnersBd->insert($tonnersData);
            }
        }

        return redirect()->route('impressoras.index');
    }

    public function delete($id){
        if(!$printer = $this->printerBd->find($id)){
            return redirect()->route('impressoras.index');
        }

        //remove os tonners antes de deletar a impressora
        $tonners = $this->tonnersBd->where('printer_id', $id)->get();
        foreach ($tonners as $tonner) {
            $tonner->delete();
        }
        
        $printer->delete();
        return redirect()->route('impressoras.index');
    }

}
