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
    	
        //\Log::info($request->all());

        $exploded = explode(',', $request->logo);

        $decoded = base64_decode($exploded[1]);
            if(str_contains($exploded[0], 'jpeg'))
                $extension = 'jpg';

            else
                $extension = 'png';
            $fileName = str_random().'.'.$extension;

            $path = public_path('/logo').'.'.$fileName;

                file_put_contents($path, $decoded);


                $settings = Setting::create($request->except('image')
                    + ['logo' => $fileName]
                );

                     

     //    $settings = Setting::findOrFail($id);
    	// $settings->update($request->all());


     //    if($request->hasFile('file')){
     //    $companylogo = $request->file('file');
     //    $filename = time() . '.' . $companylogo->getClientOriginalExtension();
     //    Image::make($companylogo)->resize(300, 300)->save(public_path('/logo/' . $filename));
        
     //    $oldlogo = $settings->logo;
     //    //updateimg
     //    $settings->logo = $filename;
     //    //delet img
     //     if ($oldlogo)
     //        Storage::delete($oldlogo);
     //    }

     //    $settings ->save();


        return ['message' => 'Company Setting successfully Updated'];
    }
}
