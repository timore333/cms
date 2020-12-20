<?php

namespace App\Models\Tenants\Medical\Insurance;

use App\Traits\General\Photoable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory, Photoable;

    protected $guarded = [];
    protected $casts = ['approved' => 'array'];

    public function request()
    {
        return $this->belongsTo(ServiceRequest::class, 'service_request_id');
    }

    public function addImage($image)
    {
        $name = 'approval_for_request_No__' . $this->clean($this->request->request_no);
        $image_data = $this->request->patient->saveImage($image, $name);
        $image_data['type'] = 'documents';
        $image_data['category'] = 'insurance';
        $image_data['description'] = 'insurance service approval for';
        $this->addPhoto($image_data);
    }

    public function approved()
    {
        $approved_procedures = [];

        // getting ids of approved procedures
        foreach($this->approved as $key => $value) {
            $ids[$key] = array_map('intval', explode('-', $this->approved[$key]))[0];
        }

        // adding procedure to approved array
        foreach($this->request->procedures as $procedure) {

            if(in_array($procedure->id, $ids)) {
                array_push($approved_procedures, $procedure);
            }
        }

        return $approved_procedures;
    }

    public function claim()
    {
        return $this->hasOne(MoneyRequest::class, 'approval_id');
    }

    public function patient()
    {
        return $this->request->patient;
    }

    public function amount()
    {
        return collect($this->approved())->pluck('pivot')->sum('price');
    }

}
