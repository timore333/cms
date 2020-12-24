<?php

namespace App\Models\Tenants\Medical;

use App\Models\Tenants\Client\Patient\Patient;
use App\Traits\General\Photoable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    use HasFactory, Photoable;

    protected $fillable = ['type', 'catigory', 'name', 'definition', 'aetiology', 'conclusion', 'clinical_features', 'histopathologic_features', 'treatment', 'diffrential_diagnosis',];

    const CATIGORIES = [
        'Bacterial Infections,', 'Developmental', 'Pulpal & Periapical', 'Periodontal', 'Physical & Chemical Injuries', 'Fungal and Protozoal Diseases', 'Viral Infections', 'Allergies and Immunologic Diseases', 'Epithelial Pathology', 'Soft Tissue Tumors', 'Salivary Gland Pathology,', 'Hematologic Disorders', 'Odontogenic Cysts and Tumors', 'Bone Pathology', 'Dermatologic Diseases', 'Facial Pain and Neuromuscular Diseases'
    ];
    const TYPES = ['systemic', 'dental'];

    const STORAGE_PATH = 'images/';

    public function photos()
    {
        return $this->morphMany('Photo', 'photoable');
    }

    public function signs()
    {
        return $this->morphToMany(Sign::class, 'signable');
    }

    public function symptoms()
    {
        return $this->morphToMany(Symptom::class, 'symptomable');
    }

    public function patients()
    {
        return $this->belongsToMany(Patient::class);
    }


}
