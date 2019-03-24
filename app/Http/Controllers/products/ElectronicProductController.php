<?php

namespace App\Http\Controllers\products;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\modules\Electronicproduct;
class ElectronicProductController extends Controller
{
     public function index()
    {
        $cats = Electronicproduct::leftjoin('vendors','vendors.id','=' ,'electronicproducts.vendor_id')
        ->leftjoin('categories','categories.id','=' ,'electronicproducts.cat_id')
        ->select('electronicproducts.id','electronicproducts.name','electronicproducts.code','electronicproducts.comppartno','electronicproducts.shortname','electronicproducts.cost','vendors.vnum','vendors.company','categories.category')
        ->paginate(100); 
        return response()->json($cats);
    }

     public function GetElec()
    {
        $cats = Electronicproduct::paginate(100);
        return $cats->toArray();
    }

    public function ElecSearch(request $request)
    {   
        $search = $request->search;
        $cats = Electronicproduct::leftjoin('vendors','vendors.id','=' ,'electronicproducts.vendor_id')
        ->leftjoin('categories','categories.id','=' ,'electronicproducts.cat_id')
        ->where('name','LIKE', "%$search%")
        ->orwhere('vnum','LIKE', "%$search%")
        ->orwhere('categories.category','LIKE', "%$search%")
        ->orwhere('comppartno','LIKE', "%$search%")
        ->orwhere('shortname','LIKE', "%$search%")
        ->orwhere('code','LIKE', "%$search%")
        ->paginate(100);
        return $cats->toArray();    
    }

    public function SearchElec(request $request)
    {
         if ($request->ajax())
        {
            $vendors = Electronicproduct::where('name', '=', $request->name)->count();
                if($vendors) {
                    $count = 'Not Available';
                    return Response($count);
                } else {
                    $count = 'Available';
                return Response($count);
            }
        }
    }
     public function ShowSingle($id)
    {
        $products = Electronicproduct::leftjoin('vendors','vendors.id' ,'=','electronicproducts.vendor_id')
        ->select('electronicproducts.id','electronicproducts.name','electronicproducts.code','electronicproducts.cost','electronicproducts.shortname','vendors.vnum','vendors.company')
        ->find($id);
        return $products->toArray();    
    }
}
