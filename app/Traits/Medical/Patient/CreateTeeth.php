<?php

namespace App\Traits\Medical\Patient;

use App\Models\Tenants\Medical\Patient\Tooth;
use App\Models\Tenants\Setting\Photo;
use Illuminate\Http\Request;


trait CreateTeeth
{

    public function teeth()
    {
        return $this->hasMany(Tooth::class)->orderBy(\DB::raw('LENGTH(uns_number), uns_number'));
    }

   protected $permanent_teeth = Tooth::PERMANENT_TEETH;
   protected $deciduous_teeth = Tooth::DECIDUOUS_TEETH;
   protected $permanent_sides = Tooth::PERMANENT_SIDES;
   protected $deciduous_sides = Tooth::DECIDUOUS_SIDES;

   protected $lowerAnteriors  = ['mesial','distal','incisal','labial','lingual', 'general'];
   protected $lowerPosteriors = ['mesial','distal','occlusal','buccal','lingual', 'general'];
   protected $upperAnteriors  = ['mesial','distal','incisal','labial','palatal', 'general'];
   protected $upperPosteriors = ['mesial','distal','occlusal','buccal','palatal', 'general'];
   protected $images = ['default','crown','endo','crown_endo','implant'];
   protected $universal_numbering_system_permanent = Tooth::UNIVERSAL_NUMBERING_SYSTEM_PERMANENT;
   protected $universal_numbering_system_primary  = Tooth::UNIVERSAL_NUMBERING_SYSTEM_DECIDUOUS;

   public function createPermenantTeeth()
    {
        foreach ($this->permanent_teeth as $key => $value) {
            foreach ($this->permanent_sides as $side_key => $side_value) {

                $currentToothNumber = $side_key.$key;
                $tooth = new Tooth;
                $tooth->name = $value;
                $tooth->number = $currentToothNumber;
                $tooth->uns_number = $this->getPermanentUnsNumber($currentToothNumber);
                $tooth->side = $side_value;
                $tooth->type = 'permanent';

                $this->teeth()->save($tooth);
                $this->addSerfaces($tooth);

                foreach ($this->images as $image) {
                    $url = 'storage/teeth/'.$tooth->number.'/'.$image.'.'.'png';
                    $temp = new Photo();
                    $temp->name = $image;
                    $temp->type = 'image';
                    $temp->catigory = 'tooth';
                    $temp->description = $image;
                    $temp->url = $url;
                    $tooth->photos()->save($temp);
                }
                
            }
        }
    }

    
    public function createDeciduousTeeth()
    {
      foreach ($this->deciduous_teeth as $key => $value) {
        foreach ($this->deciduous_sides as $side_key => $side_value) {
          $currentToothNumber = $side_key.$key;
          $tooth = new Tooth;
          $tooth->name  = $value;
          $tooth->number = $currentToothNumber ;
          $tooth->uns_number = $this->getPrimaryUnsNumber($currentToothNumber);
          $tooth->side = $side_value;
          $tooth->type ='primary';
          
          $this->teeth()->save($tooth);
          $this->addSerfaces($tooth);
        }
      }
    }


    public function addSerfaces(Tooth $tooth)
    {
        $surfaces= $this->getToothSurfacesArray($tooth);

        foreach ($surfaces as $surface) {
            $tooth->surfaces()->create(['name' => $surface]); 
        }
        
    }

    public function getToothSurfacesArray(Tooth $tooth)
    {
        if ($tooth->is_upper()) {

           if ($tooth->is_anterior()) {
              return $this->upperAnteriors;
           }

           if ($tooth->is_posterior()) {
               return $this->upperPosteriors;
           }
        }

        if ($tooth->is_lower()) {
           
           if ($tooth->is_anterior()) {
              return $this->lowerAnteriors;
           }

           if ($tooth->is_posterior()) {
               return $this->lowerPosteriors;
           }
        }
    }

    public function getPermanentUnsNumber($tooth_number)
    {
      return $this->universal_numbering_system_permanent[$tooth_number];
    }
    public function getPrimaryUnsNumber($tooth_number)
    {
      return $this->universal_numbering_system_primary[$tooth_number];
    }

}