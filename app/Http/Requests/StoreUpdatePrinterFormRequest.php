<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Unique;

class StoreUpdatePrinterFormRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->id;
        $rules =  [
            'name' => [
                'required',
                'string',
                'max:15',
                'min:6'
            ],
            'ip' => [
                'required',
                "unique:printers",
                'string',
                'max:15',
                'min:9',
                
            ],
            'matricula' =>[
                'required',
                "unique:printers",
                'min:4',
                'max:15',
                
            ],

            'marca' => 'required|string',
            'modelo' => 'required|string', 
        ];

        if($this->_method=='PUT'){
                $rules = [
                    'ip' => [
                        'required',
                        "unique:printers,ip,{$id},id",
                        'string',
                        'max:15',
                        'min:9',
                        
                    ],
                    'matricula' =>[
                        'required',
                        "unique:printers,matricula,{$id},id",
                        'min:4',
                        'max:15',
                        
                    ],
                ];
        }

        return $rules;
    }
}
