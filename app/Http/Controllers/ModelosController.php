<?php

namespace App\Http\Controllers;

use App\Models\Modelos;
use App\Models\OidModelo;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\Stub\ReturnArgument;
use Symfony\Component\Process\Process;

class ModelosController extends Controller{
    protected $modelosBd;
    protected $oidModeloBd;

    public function __construct(Modelos $modelos, OidModelo $oidModelo){
        $this->modelosBd = $modelos;
        $this->oidModeloBd = $oidModelo;
    }

    public function delete($marca, $id){
        if(!$modelos=$this->modelosBd->find($id))
            return redirect()->route('marcas.index');

        $oidModelo = $this->oidModeloBd->firstWhere('modelo_id', $id);

        if(isset($oidModelo)){
            $oidModelo->delete();
        }
        
        $modelos->delete();

        return redirect()->route('marcas.index');
    }

    public function update(Request $request,$marca,$id){
        
        $modelo = $this->modelosBd->find($id);
        $modelo->update($request->only([
            'marca','modelo','toner','imagem'
        ]));

        return redirect()->route('marcas.index');
    }

}
