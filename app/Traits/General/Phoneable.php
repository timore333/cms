<?php

namespace App\Traits\General;

use App\Models\Tenants\General\Phone;

trait Phoneable
{
    public function phones()
    {
        return $this->morphMany(Phone::class, 'phoneable');
    }

    public function hasPhone($number)
    {
        foreach ($this->phones as $phone) {
            if (trim($phone->number) == $number) {
                return true;
            }
        }
        return false;
    }
    
    public function notHasPhone($number)
    {
        return !$this->hasPhone($number);
    }

    public function removePhone(Phone $phone)
    {
        $phone->delete();
    }

    public function removeAllPhones()
    {
        foreach ($this->phones as $phone) {
            $this->removePhone($phone);
        }
    }

    public function addPhones($data)
    {
        foreach ($data as $phone) {
          $this->addPhone($phone);
        }
    }

    public function addPhone($phone)
    {
        $p = new Phone();
        $p->type = $phone['type'];
        $p->number = $phone['number'];
        $this->phones()->save($p);
    }

}