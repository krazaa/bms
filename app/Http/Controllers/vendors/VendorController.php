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
    	$vendors = Vendor::paginate(50);
        return $vendors->toArray();
    }

    public function create()
    {
        return view('vendors.create');
    }

    public function VendorStore(request $request)
        {
        $product = new Vendor();
        $product->vnum = $request->vnum;
        $product->company = $request->company;
        $product->person = $request->person;
        $product->contact = $request->contact;
        $product->mobile = $request->mobile;
        $product->bmobile = $request->bmobile;
        $product->address = $request->address;
        $product->email = $request->email;
        $product->website = $request->website;
        $product->ntn = $request->ntn;
        $product->salestax = $request->salestax;
        $product->isActive = 1;
        $product ->save();
        
        return redirect('/dashboard')->with('success','Vendor updated successfully');
        }

    public function SearchVendor(request $request)
    {
         if ($request->ajax())
        {
            $vendors = Vendor::where('company', '=', $request->company)->count();
                if($vendors) {
                    $count = 'Not Available';
                    return Response($count);
                } else {
                    $count = 'Available';
                return Response($count);
            }
        }
    }
    public function VendorSearch(request $request)
    {   
        $search = $request->search;
        $vendors = Vendor::select('id','vnum','company','person','mobile','contact')
        ->where('company','LIKE', "%$search%")
        ->orwhere('vnum','LIKE', "%$search%")
        ->paginate(50);
        return $vendors->toArray();    
    }
}