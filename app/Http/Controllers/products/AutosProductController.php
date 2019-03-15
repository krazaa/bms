<?php

namespace App\Http\Controllers\products;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\modules\Autoproduct;
use App\modules\Vendor;

class AutosProductController extends Controller
{
    public function index(){

    	return view('products.autos');
    }

    public function NewProductFrom(){

        return view('products.autosNewProduct');
    }

    public function GetAutosProducts()
    {
    	$products = Autoproduct::with('vendorinfo')->get();
        return $products;
    }

    public function SearchAutosProduct(request $request){
       
        $search = $request->search;     
        $products = Autoproduct::where('name','LIKE', "%$search%")->get();
        return $products;         
    }

    public function ShowAutosSingle($id)
    {
    	$id = $id;

        return view('products.showautos', compact('id'));	
    }

    public function ShowSingle($id)
    {
    	$products = Autoproduct::with('vendorinfo.company')->find($id);
        return $products->toArray();	
    }

    public function ShowEdit($id)
    {
    	$products = Autoproduct::find($id);
        return $products->toArray();	
    }
    public function ProductRemove($id)
    {
    	$products = Autoproduct::find($id);
    	$products->delete();
        return back();
    }
}
