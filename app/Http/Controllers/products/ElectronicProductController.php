<?php

namespace App\Http\Controllers\products;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\modules\Electronicproduct;

use Auth;

use Image;
use Storage;

class ElectronicProductController extends Controller
{
     public function index()
    {
        $cats = Electronicproduct::leftjoin('vendors','vendors.id','=' ,'electronicproducts.vendor_id')
        ->leftjoin('categories','categories.id','=' ,'electronicproducts.category_id')
        ->select('electronicproducts.id','electronicproducts.name','electronicproducts.code','electronicproducts.manpartno','electronicproducts.cost','vendors.vnum','vendors.company','categories.category','electronicproducts.isActive','electronicproducts.photo')->orderBy('id','desc')
        ->paginate(20); 
        return response()->json($cats);
    }

     public function GetElec()
    {
        $cats = Electronicproduct::paginate(20);
        return $cats->toArray();
    }

    public function ElecSearch(request $request)
    {   
        $search = $request->search;
        $cats = Electronicproduct::leftjoin('vendors','vendors.id','=' ,'electronicproducts.vendor_id')
        ->leftjoin('categories','categories.id','=' ,'electronicproducts.category_id')
        ->where('name','LIKE', "%$search%")
        ->orwhere('vnum','LIKE', "%$search%")
        ->orwhere('categories.category','LIKE', "%$search%")
        ->orwhere('comppartno','LIKE', "%$search%")
        ->orwhere('shortname','LIKE', "%$search%")
        ->orwhere('code','LIKE', "%$search%")
        ->paginate(20);
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

     public function ElecProductStore(request $request)
    {   
       $this->validate($request, [
            'code' => 'required|unique:autoproducts',
            'name' => 'required',
            'cost' => 'required'
            
        ]);
                
        $product = new Electronicproduct();
        $product->vendor_id = $request->vendor_id;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->code = $request->code;
        $product->name = $request->name;
        $product->manpartno = $request->manpartno;
        $product->discountallowed = $request->discountallowed;
        $product->saleprice = $request->saleprice;
        $product->wsaleprice = $request->wsaleprice;
        $product->reorder = $request->reorder;
        $product->maxqty = $request->maxqty;
        $product->cost = $request->cost;
        $product->saleprice = $request->saleprice;
        $product->isActive = 1;
        $product->user_id = Auth::user()->id;
        
         if($request->hasFile('file')){
        $elecPhoto = $request->file('file');
        $filename = time() . '.' . $elecPhoto->getClientOriginalExtension();
        Image::make($elecPhoto)->resize(400, 600)->save( public_path('/electronic/' . $filename ) );
        //$user = Auth::user();
        $product->photo = $filename;
        }

        $product ->save();
        
        return (['message' => 'Product was successfull']);
        // return redirect('/dashboard')->with('success','Subject updated successfully');
    }
}
