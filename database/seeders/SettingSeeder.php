<?php

namespace Database\Seeders;

use App\Models\Tenants\General\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{

    public $setting = [
        ['name'=>'skin','value' => 'skin-default-dark'],
        ['name'=>'theme','value' => 'dark'],
        ['name'=>'locale','value' => 'en'],
        ['name'=>'slotDuration', 'value'=>'00:30'],
        ['name'=>'slotMinTime', 'value'=>'12:00:00'],
        ['name'=>'slotMaxTime', 'value'=>'24:00:00'],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->setting as $setting){
            Setting::create($setting);
        }
    }
}
