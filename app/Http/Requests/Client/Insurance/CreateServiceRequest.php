<?php

namespace App\Http\Requests\Clien\Insurance;

use App\Models\Tenants\Client\Patient\Patient;
use Illuminate\Foundation\Http\FormRequest;

class CreateServiceRequest extends FormRequest
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
            //
        ];
    }

    public function storeRquest()
    {
        
       $patient = Patient::find($this->patient);
       $request = $patient->addInsuranceServiceRequest($this->all());

       // add notification id to the request to delet it 
       // 
       $request->notification_id = $this->notification_id;

       event(new ServiceRequestCreated($request));
       
      

    }
}
