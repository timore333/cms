<?php

namespace App\Http\Controllers\Tenants\Setting;

use App\Http\Controllers\Controller;
use App\Models\Tenants\Setting\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function update(Request $request,$id)
    {
        Setting::find($id)->update($request->all());
    }
}
