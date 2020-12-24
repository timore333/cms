<?php

namespace App\Models\Tenants\Supplier;

use App\Traits\General\Phoneable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Supplier extends Model
{
    use HasFactory,  Notifiable, Phoneable;
//    use Accountable;

    protected $guarded=[];

    public function products()
    {
    	return $this->belongsToMany(Product::class);
    }
}
