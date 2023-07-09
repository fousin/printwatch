<?php

namespace App\Http\Controllers;

use App\Models\Marca;
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

    public function __construct(Marca $marcas, Modelos $modelos, Oid $oids){
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
        $oid = $this->oids->firstWhere('marca_id', $id);
        
        return view('configs.oids.edit',compact('marca', 'oid'));
    }

    public function update(Request $request, $id){
        $oids = $this->oids->firstWhere('marca_id', $id);
        $dados = $request->only([
            'oidTonerPreto',
            'oidTonerCiano',
            'oidTonerMagenta',
            'oidTonerAmarelo',
            'oidTonerMonocromatico',
            'oidTamborImagem',
            'oidUnidadeImagem',
            'oidContadorPagina'
        ]);
        $oids->update($dados);

        return redirect()->back();
    }
}

/*
'oidTonerPreto',
'oidTonerCiano',
'oidTonerMagenta',
'oidTonerAmarelo',
'oidTonerMonocromatico',
'oidTamborImagem',
'oidUnidadeImagem',
'oidContadorPagina'
*/