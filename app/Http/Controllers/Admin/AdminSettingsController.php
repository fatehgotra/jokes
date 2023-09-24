<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminSettings;
use Illuminate\Http\Request;

class AdminSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function siteSetting()
    {

        return view('admin.settings.site');
    }

    public function saveSetting(Request $request)
    {

        foreach ($request->except('_token') as $key => $part) {

            $this->validate($request, [
                $key => 'required',
            ], ['required' => 'This field can\'t be empty']);

            AdminSettings::updateOrCreate(

                [
                    'setting_key' => $key
                ],
                [

                    'setting_key' => $key,
                    'setting_value' => $part,
                ]
            );

            return redirect()->back()->with('success','Settings updated successfully!');
        }
    }
}
