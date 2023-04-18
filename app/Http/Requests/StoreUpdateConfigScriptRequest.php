<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateConfigScriptRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        $id=$this->id;

        $rules = [
            'comunity'=>[
                'required',
                'string',
            ],
            'version'=>[
                'required',
                'string'
            ],
            
        ];
        
        return $rules;
    }
}
