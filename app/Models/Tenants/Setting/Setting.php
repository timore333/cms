<?php

namespace App\Models\Tenants\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable=['name','value'];
   public $timestamps = false;
}
