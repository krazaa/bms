<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\manage\Setting;
use Image;
use Storage;

class SettingController extends Controller
{
    public function index(){
    	return view('Settings.settings.settings');
    }

    public function GetSetting()
    {
    	$settings = Setting::all();
        return $settings->toArray();
    }

    public function UpdateSetting(Request $request)
    {
    	$settings = Setting::findOrFail($request->settingid);
    	$settings->update($request->all());


        if($request->hasFile('logo')){
        $companylogo = $request->file('logo');
        $filename = time() . '.' . $companylogo->getClientOriginalExtension();
        Image::make($companylogo)->resize(300, 300)->save(public_path('/logo/' . $filename));
        
        $oldlogo = $settings->logo;
        //updateimg
        $settings->logo = $filename;
        //delet img
         if ($oldlogo)
            Storage::delete($oldlogo);
        }

        $settings ->save();

        return redirect('home')->with('success','Setting updated successfully');
    }
}
