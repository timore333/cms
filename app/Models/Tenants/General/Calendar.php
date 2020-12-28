<?php

namespace App\Models\Tenants\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'patient_id', 'start', 'end', 'patient_name', 'patient_phone', 'doctor', 'color', 'allDay', 'status', 'notes'];
    protected $casts = ['patient' => 'array', 'doctor' => 'array','allDay'=>'boolean'];
}
