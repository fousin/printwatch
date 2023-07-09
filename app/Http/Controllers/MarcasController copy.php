<?php

namespace App\Http\Controllers;

use App\Models\Marcas;
use App\Models\Modelos;
use App\Models\Oid;
use App\Models\OidModelo;
use Illuminate\Http\Request;

class MarcasController extends Controller{
    protected $bdMarcas;
    protected $bdModelos;
    protected $bdOids;
    protected $bdOidsModelo;
    
    public function __construct(Marcas $marcas, Modelos $modelos, Oid $oids, OidModelo $oidsModelo){
        $this->bdMarcas = $marcas;
        $this->bdModelos = $modelos;
        $this->bdOids = $oids;
        $this->bdOidsModelo = $oidsModelo;
    }

    public function index(){

        $marcas=$this->bdMarcas->with('modelos')->get();
        return view('configs.marcas.index', compact('marcas'));
    }

    public function edit($marca, $id){
        $marcas = $this->bdMarcas->get();
        $marca = $this->bdMarcas->find($marca);
        $modelo = $this->bdModelos->find($id);
        
        return view('configs.marcas.edit', compact('marca','modelo', 'marcas'));
    }

    public function create(){
        return view('configs.marcas.create');
    }

    public function store(Request $request){
        $marca = $request->only([
            'marca',
        ]);

        //cria a marca
        $marcaId = $this->bdMarcas->novaMarca($marca);
        //instancia oid da marca
        $this->bdOids->novoOidMarca($marcaId);


        if(isset($request->modelo)){
            $modelo = $request->only(
                'modelo', 'toner', 'imagem'
            );

            //cria novo modelo
            $modeloId = $this->bdModelos->novoModelo($modelo["modelo"],$modelo["toner"],$modelo["imagem"],$marcaId);

            //instcia oid do modelo
            $toner = $modelo['toner'];
            $this->bdOids->novoOidModelo($modeloId, $marcaId, $toner);
            
        }
        
        return redirect()->action([MarcasController::class, 'index']); ;
    }

    public function update(Request $request,$marca, $id){
        
        $marca = $this->bdMarcas->find($marca);
        $modelo = $this->bdModelos->find($id);

        $dados = $request->only([
            'marca','modelo','toner','imagem'
        ]);
        
        if(isset($dados['marca'])){
            $newMarca = $this->bdMarcas->firstWhere('marca', $dados['marca']);
            $dados['marcas_id'] = $newMarca->id;   
            unset($dados['marca']);
        }

        $modelo->update($dados);
        
        return redirect()->route('marcas.index');
    }

    public function delete($id){
        $marca = $this->bdMarcas->find($id);
        $oids = $this->bdOids->firstWhere('marcas_id', $id);

        $modelos = $marca->modelos;
        
        // Exclui todos os modelos associados à marca
        foreach ($modelos as $modelo) {
            
            $modelo->delete();
        }
        
        $oids->delete();
        $marca->delete();
        return redirect()->route('marcas.index');
    }
}