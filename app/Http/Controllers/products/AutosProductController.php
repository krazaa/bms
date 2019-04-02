<?php

namespace App\Http\Controllers\products;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\modules\Autoproduct;
use App\modules\Vendor;
use App\modules\Category;
use DB;
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
       $this->validate($request, [
            'code' => 'required|unique:autoproducts',
            'name' => 'required',
            'model' => 'required'
            
        ]);
                
        $product = new Autoproduct();
        $product->name = $request->name;
        //$product->vendor_id = $request->vendor_id;
        $product->code = $request->code;
        $product->shortname = $request->shortname;
        $product->model = $request->model;
        $product->category_id = $request->category_id;
        $product->discountallowed = $request->discountallowed;
        $product->saleprice = $request->saleprice;
        $product->wsaleprice = $request->wsaleprice;
        // $product->qty = $request->qty;
        $product->reorder = $request->reorder;
        $product->maxqty = $request->maxqty;
        $product->maxqty = $request->maxqty;
        $product->cost = $request->cost;
        $product->saleprice = $request->saleprice;
        $product->user_id = Auth::user()->id;
        $product ->save();
        
        return (['message' => 'Product was successfull']);
        // return redirect('/dashboard')->with('success','Subject updated successfully');
    }

    public function GetAutosProducts()
    {
    	$products = Autoproduct::leftjoin('categories','categories.id','=' ,'autoproducts.category_id')
        ->select('autoproducts.id','autoproducts.name','autoproducts.code','autoproducts.model','autoproducts.cost','autoproducts.shortname','autoproducts.isActive','categories.category')
        ->orderBy('id','desc')
        ->paginate(20);
        return response()->json($products);
    }

    public function SearchAutosProduct(request $request){
       
        $search = $request->search;     
        $products = Autoproduct::select('*')
        ->where('name','LIKE', "%$search%")
        ->orwhere('code','LIKE', "%$search%")
        ->orwhere('model','LIKE', "%$search%")
        ->orwhere('shortname','LIKE', "%$search%")
        //->orderBy('id','desc')
        ->get();
        return $products;         
    }

    public function ChangeStatus($id)
        {
        $bank = Autoproduct::find($id);

        if($bank->isActive == 1)
             { 
                DB::table('autoproducts')->where('id', $id)->update(['isActive' => 0]);
             
             }elseif ($bank->isActive == 0) {
                 DB::table('autoproducts')->where('id', $id)->update(['isActive' => 1]);
             }

        return ['message' => 'successfully Updated'];
    }

    public function SearchCode(request $request){
       
        if ($request->ajax())
        {
            $products = Autoproduct::select('id','code')->where('code','=', $request->code)->count();
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
    	$products = 
        Autoproduct::leftjoin('categories','categories.id','=' ,'autoproducts.category_id')
        ->select('autoproducts.id','autoproducts.name','autoproducts.code','autoproducts.category_id','autoproducts.model','autoproducts.cost','autoproducts.shortname','autoproducts.reorder','autoproducts.maxqty','autoproducts.cost','autoproducts.cashdis','autoproducts.discountallowed','autoproducts.saleprice','autoproducts.isActive','autoproducts.wsaleprice')->find($id);
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

    public function CatsGet()
    {
        $cats = Category::where('type','=','1')->where('isActive',true)->get();
        return $cats->toArray();    
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
