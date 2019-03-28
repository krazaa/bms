<?php

namespace App\Http\Controllers\brands;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\modules\Brand;

use DB;

class BrandController extends Controller
{
    public function index()
    {
    	$data = Brand::all();
    	return $data->toArray();
    }

    public function brands()
    {
    	$data = Brand::Active()->get();
    	return $data->toArray();
    }

    public function brandsListGet()
    {
        $data = Brand::select('id','type','brand','isActive',
            DB::raw('(CASE 
                        WHEN type = "1" THEN "Vehicle" 
                        WHEN type = "2" THEN "Electronic" 
                        ELSE "" 
                        END) AS type'))
        ->orderBy('id','desc')->paginate(20);
        return $data->toArray();
    }
    public function BrandEdit($id)
    {
        $data = Brand::select('id','type','brand','isActive')->find($id);
        return $data->toArray();
    }
    public function BrandED($id)
    {
    $data = Brand::find($id);

        if($data->isActive == 1)
             { 
                DB::table('brands')->where('id', $id)->update(['isActive' => 0]);
             
             }elseif ($data->isActive == 0) {
                 DB::table('brands')->where('id', $id)->update(['isActive' => 1]);
             }

        return ['message' => 'Brand successfully Updated'];
    }
    public function brandUpdate(Request $request, $id)
    {
         $data = Brand::find($id);

         $data->update($request->all());

        return ['message' => 'Record successfully Updated'];

    }
    public function BrandSearch(request $request)
    {   
        $search = $request->search;
        $data = Brand::where('brand','LIKE', "%$search%")
        ->orwhere('type','LIKE', "%$search%")
        ->orderBy('id','desc')
        ->paginate(20);
        return $data->toArray();    
    }
    public function BrandStore(Request $request)
    {
        $this->validate($request, [
            'brand' => 'required',
            'type' => 'required',
        ]);

        $data = new Brand();
        $data->type = $request->type;
        $data->brand = $request->brand;
        $data ->save();

        return ['message' => 'Brand successfully Stored'];
    }
    public function AvailabilityCheck(request $request)
    {
         if ($request->ajax())
        {
            $checkstatus = Brand::where('brands', '=', $request->account)->count();
                if($checkstatus) {
                    $count = 'Not Available';
                    return Response($count);
                } else {
                    $count = 'Available';
                return Response($count);
            }
        }
    }
    public function brandDelete($id)
    {
        $data = Brand::find($id)->delete();
        return ['message' => 'Record successfully Deleted'];
    }
}
