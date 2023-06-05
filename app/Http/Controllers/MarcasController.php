<?php

namespace App\Http\Controllers;

use App\Models\Marcas;
use App\Models\Modelos;
use App\Models\Oid;
use App\Models\OidModelo;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

        $dados = $this->bdMarcas->firstWhere('marca', $marca);
        
        if(isset($dados)){
            $marca_id = $dados->id;
        }else{
            $marca = $this->bdMarcas->create($marca);
            $marca_id = $marca->id;
        }

        $jaExistOid = $this->bdOids->firstWhere('marcas_id', $marca_id);

        if(!isset($jaExistOid)){            
            $jaExistOid = $this->bdOids->insert(["marcas_id"=>$marca_id]);
        }

        if(isset($request->modelo)){
            $modelo = $request->only(
                'modelo', 'toner', 'imagem'
            );

            $novoModelo = $this->bdModelos->create([
                "modelo" => $modelo["modelo"],"toner"=>$modelo["toner"],"imagem"=>$modelo["imagem"], "marcas_id" => $marca_id
            ]);

            $oidNovoModelo=[
                'modelo_id' => $novoModelo->id,
            ];

            if($novoModelo['toner']=='color'){
                $oidNovoModelo= $oidNovoModelo + [
                    'oid01' => $jaExistOid->oid01,
                    'oid02' => $jaExistOid->oid02,
                    'oid03' => $jaExistOid->oid03,
                    'oid04' => $jaExistOid->oid04,
                    'oid08' => $jaExistOid->oid08,
                    'oid12' => $jaExistOid->oid12,
                ];
            }else{
                $oidNovoModelo= $oidNovoModelo + [
                    'oid05' => $jaExistOid->oid05,
                    'oid09' => $jaExistOid->oid09,
                    'oid12' => $jaExistOid->oid12,
                ];
            }

            if($novoModelo['imagem']=='unidade'){
                $oidNovoModelo=  $oidNovoModelo + [
                    'oid07' => $jaExistOid->oid07,
                    'oid11' => $jaExistOid->oid11,
                ];
            }else{
                $oidNovoModelo=  $oidNovoModelo + [
                    'oid06' => $jaExistOid->oid06,
                    'oid10' => $jaExistOid->oid10,
                ];
            }

            $this->bdOidsModelo->insert($oidNovoModelo);
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

/*
ricoh
DPT_ASCOM 10.96.3.2 17471
DPT_DI 10.96.3.8 17473
DPT_DIR 10.96.3.9 17474
ICAP_CCV 10.96.3.17 17476
ICAP_DIR 10.96.3.19 17477
ICAP_DOC 10.96.3.20 17475
ICAP_CTMD 10.96.3.23 17479
IIPM_CEDOD 10.96.9.2 17480
IIPM_CIPAP 10.96.3.26 17481
IIPM_CICRI 10.96.3.29 17482
IIPM_DIR 10.96.3.32 17483
IML_CAP 10.96.3.33 17484
IML_SAG 10.96.3.36 17485
LCPT_SEC 10.96.3.45 17486
LCPT_FIS 10.96.3.44 17487
*/

/* 
408
	ICAP_CCV-MONO	10.96.3.18  17276
	ICAP_DOC-MONO	10.96.3.21  17277
	ICAP_CPIE	10.96.3.22  17278
	IIPM_PROTO	10.96.3.48  17288
    IML_NECRO	10.96.3.40  17292
	IML_LIB	    10.96.3.39  17290
	IML_SAG-MONO	    10.96.3.37  17291
	IML_DIR	    10.96.3.35  17289
	LCPT_INS	10.96.3.41  17293
    LCPT_QUIMICA	10.96.3.46  17298
	LCPT_TOX	10.96.3.47  17299
    LCPT_GENETICA	10.96.8.126  17296

    DPT_COSEL	10.96.3.5  17273
	DPT_ALMOX	10.96.3.1  17272
	DPT_EP	    10.96.3.11  17274
	DPT_PREF	10.96.3.15  17275
	IIPM_COBIO	10.96.9.3  17282
	LCPT_DIR	10.96.3.43  17295
	LCPT_AMBIENTAL	10.96.8.252  17297
*/

/*

DPT_AT-MULTMONO	DPT	10.96.3.3  17463
DPT_CORREG-MULT	DPT	10.96.3.6 17415
DPT_DI-MULT	DPT	10.96.3.7 17416
DPT_RH-MULT	DPT	10.96.3.12 17417
ICAP_CAO-MULT	DPT	10.96.3.16 17418
IIPM_COCID-MULT	DPT	10.96.3.28 17419
IML_CCM-MULT	DPT	10.96.3.34 17233
IML_SEC-MULT	DPT	10.96.3.38 17421
LCPT_CAO-MULT	DPT	10.96.3.42 17422

*/