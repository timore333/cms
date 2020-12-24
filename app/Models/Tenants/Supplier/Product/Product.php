<?php

namespace App\Models\Tenants\Supplier\Product;

use App\Models\Tenants\Operation\Protocol;
use App\Models\Tenants\Supplier\Supplier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    const FORMS  =['Bowder','Drops','Duogh','Capsule','Sheat','Solution','Paste','Liquid','Strip','Carpule','Tablet','Brush', 'Resin'];

    const BAKAGE =['Bottle','Syrenge','Bag','Packet','Box','Carpule','Can','Tube','Roll'];

    const UNITS  = ['unit','gm', 'kg','ml'];


    public function invoices()
    {
        return $this->belongsToMany(Invoice::class)->withPivot('price','qty');
    }

    public function vouchers()
    {
        return $this->belongsToMany(Voucher::class)->withPivot('price','qty');

    }

    public function card()
    {
        return $this->hasOne(Card::class);
    }

    public function productCatigory()
    {
    	return $this->belongsTo(ProductCategory::class);
    }

    public function dentalCompany()
    {
    	return $this->belongsTo(DentalCompany::class);
    }

    public function suppliers()
    {
    	return $this->belongsToMany(Supplier::class);
    }

    public function protocols()
    {
        return $this->belongsToMany(Protocol::class)->withPivot('qty');
    }

    public function createCard()
    {
        // the card by default attached to the main store. we set this in DB table
        $card = new Card;
        $this->card()->save($card);
    }
}
