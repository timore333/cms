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
