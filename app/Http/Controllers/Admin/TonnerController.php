<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SnmpController;
use App\Models\{
    Printer,
    Tonner
};
use Illuminate\Http\Request;

class TonnerController extends Controller{
    protected $tonner;
    protected $printer;
    
    public function __construct(Tonner $tonner, Printer $printer){
        $this->tonner = $tonner;
        $this->printer = $printer;
    }

    public function index($printerId){
        if(!$printer = $this->printer->find($printerId)){
            return redirect()->back();
        }
        $tonners = $printer->tonners()->get();

        return view('impressoras.tonners.indexColorida', compact('printer', 'tonners'));
    }

    public function create($printerId){
        if(!$printer = $this->printer->find($printerId)){
            return redirect()->back();
        }

        return view('impressoras.tonners.create', compact('printer'));
    }

    public function store(Request $request, $printerId){
        if(!$printer = $this->printer->find($printerId)){
            return redirect()->back();
        }
        $printer->Tonners()->create($request->all());

        return redirect()->route('tonners.indexColorida',$printer->id);
    }

    
}
