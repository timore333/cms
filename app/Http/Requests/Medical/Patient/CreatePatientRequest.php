<?php

namespace App\Http\Requests\Medical\Patient;


use App\Events\Tenants\Meical\Patients\PatientCreated;
use App\Models\Tenants\Medical\Patient\Patient;
use Illuminate\Foundation\Http\FormRequest;


class CreatePatientRequest extends FormRequest
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
            'gender' => 'required',
            'birth_date' => 'required',
            'payment' => 'required',
            // 'card_id' => 'required_if:payment,==,insurance',
        ];
    }

    public function update()
    {
        $data = $this->only('name', 'email', 'address', 'gender', 'birth_date', 'payment');

        $this->patient = new Patient;

        foreach($data as $key => $value) {
            $this->patient[$key] = $value;
        }

        $this->patient->save();

        if($this['phones']) {
             $this->patient->addPhones($this['phones']);
        }

        if($this['profile_image']) {
            $this->patient->profile = $this['profile_image'];
        }

        if($this['payment'] === 'insurance') {
            $this->patient->insurance = ($this['insurance']);
        }

        event(new PatientCreated($this->patient));

    }


}
