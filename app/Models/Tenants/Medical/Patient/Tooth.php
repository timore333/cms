<?php

namespace App\Models\Tenants\Medical\Patient;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tooth extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name', 'number', 'side', 'type', 'uns_number', 'patient_id'];
    protected $with = ['surfaces', 'photos'];
    protected $appends = ['finding'];
    //    use photoable;

    const PERMANENT_TEETH = [
        1 => 'central incisor',
        2 => 'lateral incisor',
        3 => 'canine',
        4 => 'first premolar',
        5 => 'second premolar',
        6 => 'first molar',
        7 => 'second molar',
        8 => 'third molar'
    ];

    const DECIDUOUS_TEETH = [
        1 => 'central incisor',
        2 => 'lateral incisor',
        3 => 'canine',
        4 => 'first molar',
        5 => 'second molar'
    ];

    const PERMANENT_SIDES = [
        1 => 'upper right',
        2 => 'upper left',
        3 => 'lower left',
        4 => 'lower right',
    ];

    const DECIDUOUS_SIDES = [
        5 => 'upper right',
        6 => 'upper left ',
        7 => 'lower left',
        8 => 'lower right',
    ];
    const UNIVERSAL_NUMBERING_SYSTEM_PERMANENT = [18 => 1, 17 => 2, 16 => 3, 15 => 4, 14 => 5, 13 => 6, 12 => 7, 11 => 8, 21 => 9, 22 => 10, 23 => 11, 24 => 12, 25 => 13, 26 => 14, 27 => 15, 28 => 16, 38 => 17, 37 => 18, 36 => 19, 35 => 20, 34 => 21, 33 => 22, 32 => 23, 31 => 24, 41 => 25, 42 => 26, 43 => 27, 44 => 28, 45 => 29, 46 => 30, 47 => 31, 48 => 32];

    const UNIVERSAL_NUMBERING_SYSTEM_DECIDUOUS = [
        51 => 'A', 52 => 'B', 53 => 'C', 54 => 'D', 55 => 'E', 61 => 'F', 62 => 'G', 63 => 'H', 64 => 'I',
        65 => 'J', 75 => 'K', 74 => 'L', 73 => 'M', 72 => 'N', 71 => 'O', 81 => 'P', 82 => 'Q', 83 => 'R',
        84 => 'S', 85 => 'T'];

    public function getNameAttribute($value)
    {
        $side = title_case($this->side);
        return $side . ' ' . title_case($value);
    }

    public function getFindingAttribute($value)
    {
        return $this->findings();
    }

    static function toothNumber($number)
    {
        return Tooth::where('number', $number)->first();
    }

    public function getSurface($value)
    {
        return $this->surfaces()->where('name', $value)->first();
    }

    public function getSideNumber()
    {
        if($this->is_permenant()) {
            return array_search($this->side, Tooth::PERMANENT_SIDES);
        }

        if($this->is_deciduous()) {
            return array_search($this->side, Tooth::DECIDUOUS_SIDES);
        }
        return false;
    }

    public function findings()
    {
        $allFinding = [];
        foreach($this->surfaces as $surface) {
            foreach($surface->findings as $finding) {
                array_push($allFinding, $finding);
            }
        }
        return $allFinding;
    }

    public function surfaces()
    {
        return $this->hasMany(ToothSurface::class);
    }

    public function is_permenant()
    {
        return $this->type == 'permanent';
    }

    public function is_deciduous()
    {
        return !$this->is_permenant();
    }

    public function is_upper()
    {
        return $this->uns_number < 17;
    }

    public function is_lower()
    {
        return !$this->is_upper();
    }

    public function is_anterior()
    {
        // to be anterior the tooh second number should be 1,2,3
        $num = substr($this->number, 1);
        return in_array((int)$num, [1, 2, 3]);
    }

    public function is_posterior()
    {
        return !$this->is_anterior();
    }


    public function scopePermanent($query)
    {
        return $query->where('type', 'permanent')->orderBy(DB::raw('LENGTH(uns_number), uns_number'));
    }

    public function scopePrimary($query)
    {
        return $query->where('type', 'primary')->orderBy('uns_number');
    }


}
