<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SnmpController;
use App\Models\{
    Printer,
    Toner
};
use Illuminate\Http\Request;

class TonerController extends Controller{
    protected $toner;
    protected $printer;
    
    public function __construct(Toner $toner, Printer $printer){
        $this->toner = $toner;
        $this->printer = $printer;
    }

    public function index($printerId){
        if(!$printer = $this->printer->find($printerId)){
            return redirect()->back();
        }
        $toners = $printer->toners()->get();

        return view('impressoras.toners.indexColorida', compact('printer', 'toners'));
    }

    public function create($printerId){
        if(!$printer = $this->printer->find($printerId)){
            return redirect()->back();
        }

        return view('impressoras.toners.create', compact('printer'));
    }

    public function store(Request $request, $printerId){
        if(!$printer = $this->printer->find($printerId)){
            return redirect()->back();
        }
        $printer->Toners()->create($request->all());

        return redirect()->route('toners.indexColorida',$printer->id);
    }

    
}
