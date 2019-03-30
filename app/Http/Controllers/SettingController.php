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

    public function GetSetting($id) 
    {
    	$settings = Setting::find($id);
        return $settings->toArray();
    }

    public function UpdateSetting(Request $request, $id)
    {
    	              

        $settings = Setting::findOrFail($id);
        $settings->company = $request->comp;


        if($request->hasFile('file')){
        $companylogo = $request->file('file');
        $filename = time() . '.' . $companylogo->getClientOriginalExtension();
        Image::make($companylogo)->resize(300, 300)->save(public_path('/logo/' . $filename));
        
        $oldlogo = $settings->logo;
        //updateimg
        $settings->logo = $filename;
        //delet img
         if ($oldlogo)
            Storage::delete($oldlogo);
        }
        $settings->update($request->all());

        $settings ->save();


        return ['message' => 'Company Setting successfully Updated'];
    }
}
