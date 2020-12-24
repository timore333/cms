<?php

namespace App\Traits\Client\Patient;


use App\Models\Tenants\Client\Insurance\Card;
use App\Models\Tenants\Client\Insurance\ServiceRequest;
use App\Models\Tenants\Managment\Ledger\PriceList;

trait Insuranceable
{


    public function card()
    {
        return $this->hasOne(Card::class);
    }

    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class);
    }

    public function priceList()
    {
        if($this->card) {

            return $this->card->company->priceList;
        }
        return PriceList::first();
    }

    public function addInsuranceCard($data)
    {
        $card = new Card;

        $card->card_id = $data['card_id'];
        $card->insurance_no = $data['insurance_no'];
        $card->company_id = $data['insurance_company_id'];
        $card->effective = $data['effective'];
        $card->expiry = $data['expiry'];
        $card->deductible = $data['deductible'];
        $card->co_ins = $data['co_ins'];
        $card->job_company = $data['job_company'];
        $card->policy_holder = $data['policy_holder'];
        $card->network = $data['network'];
        $card->catigory = $data['catigory'];
        $card->dental = $data['dental'];

        $this->card()->save($card);

        if($data['image']) {
            $card->addImage($data['image']);
        }

        return $card;

    }

    public function addInsuranceServiceRequest($data)
    {

        $request = new ServiceRequest();
        $request->request_no = $data['request_no'];
        $request->past_medical_history = 'free';
        $request->chief_complaint = 'pain';
        $request->diagnosis = 'caires';
        $request->duration_of_sickness = 'a week';
        $request->drugs = $data['drugs'];
        $request->lab = $data['lab'];
        $request->radiology = $data['radiology'];
        $request->company_id = $this->card->company->id;

        $this->serviceRequests()->save($request);

        foreach($data['procedures'] as $procedure) {
            $request->addProcedure($procedure);
        }

        if($data['image']) {
            $request->addImage($data['image']);
        }

        return $request;

    }

    public function deleteInsuranceCard()
    {
         $card = $this->card;
         $card->patient()->dissociate();
         $card->delete();
    }

    public function hasInsuranceCard(){
        return $this->card !== null;
    }


}

