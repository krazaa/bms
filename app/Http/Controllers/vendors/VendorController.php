<?php

namespace App\Http\Controllers\vendors;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\modules\Vendor;
use App\modules\Autoproduct;
use DB;

class VendorController extends Controller
{
    public function index(){

    	return view('vendors.vendors');
    }

    public function GetVendors()
    {
    	$vendors = Vendor::select('id','type','brand_id','company','vnum','person','mobile','ntn','salestax','isActive',
            DB::raw('(CASE 
                        WHEN type = "1" THEN "Vehicles" 
                        WHEN type = "2" THEN "Electronic" 
                        ELSE "" 
                        END) AS type'))
        ->orderBy('id','desc')->with('brands:id,brand')->orderBy('id','desc')->paginate(20);
        return $vendors->toArray();
    }

    public function GetVendorsElec()
        {
            $vendors = Vendor::select('id','type','company','person','isActive',
                DB::raw('(CASE 
                            WHEN type = "1" THEN "Vehicles" 
                            WHEN type = "2" THEN "Electronic" 
                            ELSE "" 
                            END) AS type'))
            ->where('type',2)
            ->Active()
            ->orderBy('id','desc')->with('brands:id,brand')->orderBy('id','desc')->paginate(20);
            return $vendors->toArray();
        }

        public function GetVendorsAuto()
        {
            $vendors = Vendor::select('id','type','company','person','isActive',
                DB::raw('(CASE 
                            WHEN type = "1" THEN "Vehicles" 
                            WHEN type = "2" THEN "Electronic" 
                            ELSE "" 
                            END) AS type'))
            ->where('type',1)
            ->Active()
            ->get();
            return $vendors->toArray();
        }
          public function GetVendorsServices()
        {
            $vendors = Vendor::select('id','type','company','person','isActive',
                DB::raw('(CASE 
                            WHEN type = "1" THEN "Vehicles" 
                            WHEN type = "2" THEN "Electronic" 
                            ELSE "" 
                            END) AS type'))
            ->where('type',3)
            ->Active()
            ->orderBy('id','desc')->get();
            return $vendors;
        }

    public function create()
    {
        return view('vendors.create');
    }
     public function VendorEdit($id)
    {
        $vendors = Vendor::find($id);
        return $vendors->toArray();
    }

        public function VendorhUpdate(Request $request, $id)
    {
        $Vendor = Vendor::findOrFail($id);  
        $Vendor ->update($request->all());
        $Vendor ->save();
        
        return ['message' => 'Vendor successfully Updated'];
    }

    public function VendorStore(request $request)
        {
            $this->validate($request, [
            'company' => 'required|unique:vendors',
            'vnum' => 'required|unique:vendors',
            'person' => 'required',
            'mobile' => 'required',
            'contact' => 'required',
            'address' => 'required'
        ],[

            'company.required' => 'Company Name required.',
            'vnum.required' => 'Code required.',
            'person.required' => 'Person required',
            'mobile.required' => 'Mobile required',
            'contact.required' => 'Telephone required',
            'address.required' => 'Address required'

           ]);

        $product = new Vendor();
        $product->brand_id = $request->brand_id;
        $product->type = $request->type;
        $product->vnum = $request->vnum;
        $product->company = $request->company;
        $product->person = $request->person;
        $product->contact = $request->contact;
        $product->mobile = $request->mobile;
        $product->bmobile = $request->bmobile;
        $product->address = $request->address;
        $product->city = $request->city;
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
        ->orderBy('id','desc')
        //->get();
        ->paginate(5);
        return $vendors->toArray();    
    }

    public function VendorED($id)
    {
    $vendor = Vendor::find($id);

        if($vendor->isActive == 1)
             { 
                DB::table('vendors')->where('id', $id)->update(['isActive' => 0]);
             
             }elseif ($vendor->isActive == 0) {
                 DB::table('vendors')->where('id', $id)->update(['isActive' => 1]);
             }

        return ['message' => 'Vendor successfully Updated'];
    }
    public function RecordDelete($id)
    {
        $autos = Autoproduct::where('vendor_id',$id)->count();
            if($autos) {
                return ['message' => 'Vendor is not empty'];
               } else {
                $count = Vendor::find($id)->delete();
                return ['message' => 'Successfully Deleted'];
            }

        // $data = Vendor::find($id)->delete();
        // return ['message' => 'Vendor successfully Deleted'];
    }
}