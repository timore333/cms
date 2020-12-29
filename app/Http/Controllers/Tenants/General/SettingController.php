<?php

namespace App\Http\Controllers\Tenants\General;

use App\Http\Controllers\Controller;
use App\Models\Tenants\General\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function update(Request $request,$id)
    {
        Setting::find($id)->update($request->all());
    }

    public function store(Request $request){
        foreach($request->all() as $key => $val){
            $setting = Setting::where('name', $key)->first()->update(['name' => $key, 'value'=>$val]);
        }
    }
}
