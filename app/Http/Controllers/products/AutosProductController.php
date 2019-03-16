<?php

namespace App\Http\Controllers\products;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\modules\Autoproduct;
use App\modules\Vendor;

use Auth;

class AutosProductController extends Controller
{
    public function index(){

    	return view('products.autos');
    }

    public function NewProductFrom(){

        return view('products.autosNewProduct');
    }

    public function AutoProductStore(request $request)
    {
        $product = new Autoproduct();
        $product->name = $request->name;
        $product->vendor_id = $request->vendor_id;
        $product->code = $request->code;
        $product->shortname = $request->shortname;
        $product->model = $request->model;
        $product->model = $request->model;
        $product->discountallowed = $request->discountallowed;
        $product->saleprice = $request->saleprice;
        $product->wsaleprice = $request->wsaleprice;
        $product->qty = $request->qty;
        $product->reorder = $request->reorder;
        $product->maxqty = $request->maxqty;
        $product->maxqty = $request->maxqty;
        $product->cost = $request->cost;
        $product->saleprice = $request->saleprice;
        $product->user_id = Auth::user()->id;
        $product ->save();
        
        return redirect('/dashboard')->with('success','Subject updated successfully');
    }

    public function GetAutosProducts()
    {
    	$products = Autoproduct::leftjoin('vendors','vendors.id','=' ,'autoproducts.vendor_id')->get();
        return $products;
    }

    public function SearchAutosProduct(request $request){
       
        $search = $request->search;     
        $products = Autoproduct::leftjoin('vendors','vendors.id','=' ,'autoproducts.vendor_id')
        ->where('name','LIKE', "%$search%")
        ->orwhere('code','LIKE', "%$search%")
        ->orwhere('company','LIKE', "%$search%")
        ->orwhere('model','LIKE', "%$search%")
        ->orwhere('shortname','LIKE', "%$search%")
        ->get();
        return $products;         
    }

    public function SearchCode(request $request){
       
        if ($request->ajax())
        {
            $products = Autoproduct::where('code','=', $request->code)->count();
                if($products) {
                //abort(405, 'Code already entered'); 
                    $count = 'Not Available';
                return Response($count);
                } else {
                    $count = 'Available';
                return Response($count);
            }     
        }
    }

    public function ShowAutosSingle($id)
    {
    	$id = $id;

        return view('products.showautos', compact('id'));	
    }

    public function ShowSingle($id)
    {
    	$products = Autoproduct::leftjoin('vendors','vendors.id' ,'=','autoproducts.vendor_id')->find($id);
        return $products->toArray();	
    }

    public function ShowAutosEdit($id)
    {
        $id = $id;

        return view('products.autosEditProduct', compact('id'));   
    }

    public function ShowEdit($id)
    {
    	$products = Autoproduct::find($id);
        return $products->toArray();	
    }
     public function AutosUpdate(Request $request, $id)
    {
        $subjects = Autoproduct::findOrFail($id);  
        $subjects ->update($request->all());
        $subjects ->save();
        
        return redirect('/dashboard')->with('success','Subject updated successfully');
    }

    public function AutoShow($id)
    {
        $id = $id;

        return view('products.showautos',compact('id'));
    }

    public function ProductRemove($id)
    {
    	$products = Autoproduct::find($id);
    	$products->delete();
        return back();
    }
}
