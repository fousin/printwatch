<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateConfigScriptRequest;
use App\Models\ConfigScript;
use App\Models\Marca;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\Stub\ReturnArgument;
use Symfony\Component\Process\Process;

class ConfigScriptController extends Controller{
    protected $model;

    public function __construct(ConfigScript $config){
        $this->model = $config;
    }

    public function index(Request $request){
        $configs = ConfigScript::get()->all();
        
        return view('configs.index', compact('configs'));
    }

    public function update(StoreUpdateConfigScriptRequest $request, $id){
        $config = ConfigScript::findOrFail($id);
        $config->update($request->only([
            'comunity', 'version', 'marca', 'modelo','critico', 'emergencia', 'aviso', 'saudavel'
        ]));

        return redirect()->route('configs.index');
    }

    public function edit($id){
        $config = ConfigScript::findOrFail($id);

        return view('configs.index', compact('config','marcas'));
    }
}
