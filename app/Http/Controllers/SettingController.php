<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\manage\Setting;

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
            $originalFileName = $companylogo->getClientOriginalName();
            $extension = $companylogo->getClientOriginalExtension();
            $fileNameOnly = pathinfo($originalFileName, PATHINFO_FILENAME);
            $fileName = $fileNameOnly. "-" . time().".".$extension;

        
            
         //Image::make($StdPhoto)->resize(300, 300)->save(public_path('/logo/' . $filename));
        
        //$oldpic = $settings->logo;
        //updateimg
        $settings->logo = $companylogo->storeAs('logos', $fileName);
        //delet img
    
        // if ($oldpic)
        //   unlink(public_path('/settings-pics/'. $oldpic));
        }

        $settings ->save();

        return redirect('home')->with('success','Setting updated successfully');
    }
}
