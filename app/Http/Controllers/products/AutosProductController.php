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
        $product->user_id = Auth::user()->id;
        $product ->save();
        
        return redirect('/dashboard')->with('success','Subject updated successfully');

        return view('products.autosNewProduct');
    }

    public function GetAutosProducts()
    {
    	$products = Autoproduct::with('vendorinfo')->get();
        return $products;
    }

    public function SearchAutosProduct(request $request){
       
        $search = $request->search;     
        $products = Autoproduct::where('name','LIKE', "%$search%")->orwhere('shortname','LIKE', "%$search%")
        ->get();
        return $products;         
    }

    public function ShowAutosSingle($id)
    {
    	$id = $id;

        return view('products.showautos', compact('id'));	
    }

    public function ShowSingle($id)
    {
    	$products = Autoproduct::find($id);
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

    public function ProductRemove($id)
    {
    	$products = Autoproduct::find($id);
    	$products->delete();
        return back();
    }
}
