<?php

namespace App\Http\Controllers;

use App\Models\Marcas;
use App\Models\Modelos;
use App\Models\Oid;
use App\Http\Requests\OidRequest;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\Stub\ReturnArgument;
use Symfony\Component\Process\Process;

class OidsController extends Controller{
    protected $marcas;
    protected $modelos;
    protected $oids;

    public function __construct(Marcas $marcas, Modelos $modelos, Oid $oids){
        $this->marcas = $marcas;
        $this->modelos = $modelos;
        $this->oids = $oids;
    }

    public function index(){
        $allMarcas =$this->marcas->with('modelos')->get();
        return view('configs.oids.index', compact('allMarcas'));
    }

    public function edit($id){
        $marca = $this->marcas->find($id);
        $oid = $this->oids->firstWhere('marcas_id', $id);
        
        return view('configs.oids.edit',compact('marca', 'oid'));
    }

    public function update(Request $request, $id){
        $oids = $this->oids->firstWhere('marcas_id', $id);
        $dados = $request->only([
            'oid01','oid02','oid03','oid04', 'oid05', 'oid06', 'oid07','oid08', 'oid09'
        ]);
        $oids->update($dados);

        return redirect()->back();
    }
}
