<?php

namespace App\Http\Controllers\products;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\modules\Electronicproduct;
class ElectronicProductController extends Controller
{
    public function index(){

    	return view('products.electronic');
    }

    public function GetAutosProducts()
    {
    	$products = Electronicproduct::all();
        return $products->toArray();
    }

    public function SearchAutosProduct(request $request){
       
        $search = $request->search;     
        $products = Electronicproduct::where('name','LIKE', "%$search%")->get();
        return $products;         
    }

    public function ShowAutosSingle($id)
    {
    	$id = $id;

        return view('products.showelectronic', compact('id'));	
    }

    public function ShowSingle($id)
    {
    	$products = Electronicproduct::find($id);
        return $products->toArray();	
    }

    public function ShowEdit($id)
    {
    	$products = Electronicproduct::find($id);
        return $products->toArray();	
    }
    public function ProductRemove($id)
    {
    	$products = Electronicproduct::find($id);
    	$products->delete();
        return back();
    }
}