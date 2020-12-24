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
}
