<?php

namespace App\Models\Tenants\Medical\Drug;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    use HasFactory;

    protected $fillable = ['name','scientific_name','form','use','dose','price','indications','precautions','company','pamphlet','concentration'];

    const FORMS = ['tab'=>'Tablet','cap'=>'Capsule','amp' =>'Ampule','eff'=>'Effervescent','susp'=>'Suspension','emu'=>'Emulsion','syp'=>'Syrup','drop'=>'Drops','pill'=>'Pill','gargle'=>'Gargle','M.W'=>'Mouthwash','gel'=>'Gel','carpule'=>'carpule','supp'=>' Suppository','lozenge'=>'Lozenge','ointment'=>'Ointment','cream'=>'Cream'];

    const USES = ['Mouth wash','Antibiotic','Antiviral','Anti-fungal','Analgesic','Anti-histamine','Anti-inflammatory','Anticoagulant','Ulcers'];

    const COMPANIES = ['Abbott','Acdima','Acino','Adco','ADG','Adwia','Alesraa','Alexandria','Alfacure','Allergan','Amgen','Amoun','Andalous','Apex','Astellas','Astra','AUG','Aventis','Averroes','Bayer','Biofactor','Boeheringer','Borge','Chemiph','CID','Copad','D.D.D','Debeiky','Delta','Dumex','Ebewe','Egpi','Egyphar','Eipico','Elililly','EVA','Ferring','FPI','Globe','GNP','GSK','Hero','Hikma','Hochster','Hygint','Ibsa','Inspire','Jamjoom','Johnson','Julphar','Kahira','LEO','Liptis','Lundbeck','M.S.D','Macro','Marcyrl','Mash','Memphis','Mepaco','Merck','Minapharm','Misr','Mundi','MUP','Nasr','Nerhadou','Nestle','Nile','Novo','Nutribio','Nutricia','Ocober','Orchidia','Organo','Otsuka','Penta','Pfizer','Pharaonia','Pharco','Pharmacage','Pharmalys','Rameda','Ranbaxy','Reckitt','Regilait','Roche','Rowa','Sedico','Sekem','Servier','Sigma','Spimaco','Tabuk','Takeda','Uni pharma','Utopia','Vitabiotics','Western'];

    public static function concentrations(){
    	return self::all()->unique('concentration')->pluck('concentration');
    }

    public static function forms(){
    	return self::all()->unique('form')->pluck('form');
    }


}
