<?php

namespace App\Http\Requests\Medical\Patient;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class UpdatePatientRequest extends FormRequest
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
//            'name' => 'required',
//            'gender' => 'required',
//            'birth_date' => 'required',
//            'payment' => 'required',
            // 'card_id' => 'required_if:payment,==,insurance',
        ];
    }

    public function update()
    {
        switch($this->key) {

            case 'allergies':
                $this->updateAllergies($this->data);
                break;
            case 'diseases':
                $this->updateDiseases($this->data);
                break;
            case 'xray':
                $this->updateXray($this->data);
                break;

            default:
                $this->updatePersonalData($this);
                break;
        }
    }

    public function updateAllergies($allergies)
    {
        foreach($allergies as $allergy) {
            if($this->patient->notHasAllergy($allergy['id'])) {
                $this->patient->allergies()->attach($allergy['id']);
            }
        }
    }

    public function updateDiseases($diseases)
    {
        foreach($diseases as $disease) {
            if($this->patient->notHasDisease($disease['id'])) {
                $this->patient->diseases()->attach($disease['id']);
            }
        }
    }

    public function updateXray($xRay)
    {

        $data = $this->patient->saveImage($xRay['image'], Carbon::today()->toDateString() . '_' . rand(1000, 1));
        $data['type'] = 'x-ray';
        $data['category'] = $xRay['catigory'];
        $data['description'] = $xRay['description'];
        $this->patient->addPhoto($data);

    }

    public function updatePersonalData()
    {
        $this->updatePhones();
        $this->updateInsurance();
        $this->patient->update($this->all());
    }

    public function updateInsurance(): void
    {
        // check if patient has insurance card
        if($this->patient->hasInsuranceCard()) {

            if($this->payment === 'cash') {
                $this->patient->deleteInsuranceCard();
            } else {
                // if we have insurance details, delete old card and add the new one
                if($this->insurance) {
                    $this->patient->deleteInsuranceCard();
                    $this->patient->addInsuranceCard($this->insurance);
                }
            }
        } else {
            if($this->insurance) {
                $this->patient->addInsuranceCard($this->insurance);
            }
        }
    }

    public function updatePhones()
    {
        $this->patient->removeAllPhones();
        $this->patient->addPhones($this->phones);
    }


}
