<?php

namespace App\Http\Requests\Medical;

use Illuminate\Foundation\Http\FormRequest;

class CreateDrugsRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'scientific_name' => 'required',
            'form' => 'required',
            'use'=>'required',
            'dose' =>'required',
            'concentration' => 'required',
            'price' => 'required',
            'indications' => 'required',
            'precautions' => 'required',
            'pamphlet' => 'required',
            'company' => 'required'
        ];
    }
}
