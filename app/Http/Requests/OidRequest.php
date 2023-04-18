<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OidRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [];
        $campoRules ='nullable';

        for($i=1;$i<=7;$i++){
            $campoOid = "oid" . str_pad($i, 2, "0", STR_PAD_LEFT);
            $rules[$campoOid] = $campoRules . [
                Rule::unique('oids',[])->where(function ($query) {
                    return $query->where("oid$i", $this->oid);
                }),

            ];
        }

        dd($rules);
        return $rules;
    }

    public function messages()
    {
        return [
            'required_without_all' => 'Pelo menos um campo precisa ser preenchido',
        ];
    }
}
