<?php

namespace App\Models\Tenants\Operation;

use App\Models\Tenants\Client\Insurance\ServiceRequest;
use App\Models\Tenants\Managment\Ledger\PriceList;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    use HasFactory;
      protected $fillable= ['name','description'];

    public static array $catigories = [
        'Diagnosis' => 'Diagnosis',
        'Surgery' => 'Surgery',
        'Pedodontic' => 'Pedodontic',
        'Operative' => 'Operative',
        'Endodontic' => 'Endodontic',
        'Fixed' => 'Fixed Prosthesis',
        'Removable' => 'Removable Prosthesis',
        'Orthodontics' => 'Orthodontics',
        'Maxillofacial' => 'Maxillofacial',
        'Periodontics' => 'Periodontics'
    ];

    public function visits()
    {
    	return $this->belongsToMany(Visit::class)
            ->withPivot('notes','tooth_id','completed');
    }

    public function priceLists()
    {
    	return $this->belongsToMany(PriceList::class)
            ->withPivot('price','code');
    }

    public function pills()
    {
        return $this->belongsToMany(Pill::class)
            ->withPivot('price','tooth_id','completed');
    }

    public function protocole()
    {
        return $this->hasOne(Protocol::class);
    }

    public function insuranceServiceRequests()
    {
    	return $this->belongsToMany(ServiceRequest::class)
            ->withPivot('price','tooth_id','tooth_number','tooth_uns_number','tooth_name', 'code');
    }
}
