<?php

namespace App\Http\Controllers\vendors;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\modules\Vendor;

class VendorController extends Controller
{
    public function index(){

    	return view('vendors.vendors');
    }

    public function GetVendors()
    {
    	$vendors = Vendor::all();
        return $vendors->toArray();
    }

    public function check()
    {
        if (Vendor::where('email', '=' ,'Sss@aa.com')->first()) {
            return '<font color="red" style="margin-left:105px;"><STRONG>'.$email.'</STRONG> is not available.</font>';
        }

        return 'OK';
    }
}
