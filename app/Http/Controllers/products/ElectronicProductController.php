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
        ->leftjoin('categories as subcategory','subcategory.id','=' ,'electronicproducts.subcategory_id')
        ->select('electronicproducts.id','electronicproducts.name','electronicproducts.code','electronicproducts.manpartno','electronicproducts.cost','vendors.company','categories.category','subcategory.category as subcategory','electronicproducts.isActive','electronicproducts.photo')->orderBy('id','desc')
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
        ->select('electronicproducts.id','electronicproducts.name','electronicproducts.code','electronicproducts.cost','electronicproducts.manpartno','vendors.vnum','vendors.company','electronicproducts.vendor_id','electronicproducts.category_id','electronicproducts.subcategory_id','electronicproducts.qty','electronicproducts.maxqty','electronicproducts.reorder','electronicproducts.cashdis','electronicproducts.discountallowed','electronicproducts.wsaleprice','electronicproducts.saleprice','electronicproducts.photo')
        ->find($id);
        return $products->toArray();    
    }

     public function ElecProductStore(request $request)
    {   
       $this->validate($request, [
            'code' => 'required|unique:electronicproducts',
            'name' => 'required',
            'manpartno' => 'required',
            'maxqty' => 'required',
            'reorder' => 'required',
            'saleprice' => 'required',
            'wsaleprice' => 'required',
            'cost' => 'required'
            
        ],[

            'code.required' => 'Code required.',
            'name.required' => 'Product required.',
            'manpartno.required' => 'Manufacturer required',
            'maxqty.required' => 'Max Qty required',
            'reorder.required' => 'Reorder required',
            'saleprice.required' => 'Sale Price required',
            'wsaleprice.required' => 'Whole Sale Price required',
            'cost.required' => 'Cost required'

           ]);
                
        $product = new Electronicproduct();
        $product->vendor_id = $request->vendor_id;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->code = $request->code;
        $product->name = $request->name;
        $product->manpartno = $request->manpartno;
        $product->discountallowed = $request->discountallowed;
        $product->cashdis = $request->cashdis;
        $product->saleprice = $request->saleprice;
        $product->wsaleprice = $request->wsaleprice;
        $product->reorder = $request->reorder;
        $product->qty = $request->qty;
        $product->maxqty = $request->maxqty;
        $product->cost = $request->cost;
        $product->isActive = 1;
        $product->user_id = Auth::user()->id;
        
         if($request->hasFile('file')){
        $elecPhoto = $request->file('file');
        $filename = time() . '.' . $elecPhoto->getClientOriginalExtension();
        Image::make($elecPhoto)->resize(400, 400)->save( public_path('/electronic/' . $filename ) );
        //$user = Auth::user();
        $product->photo = $filename;
        }

        $product ->save();
        
        return (['message' => 'Product was successfull']);
        // return redirect('/dashboard')->with('success','Subject updated successfully');
    }

     public function UpdateElecProduct(Request $request, $id)
       {
                      
        $updateData = Electronicproduct::findOrFail($id);
        $updateData->vendor_id = $request->vendor_id;
        $updateData->category_id = $request->category_id;
        $updateData->subcategory_id = $request->subcategory_id;
        $updateData->code = $request->code;
        $updateData->name = $request->name;
        $updateData->manpartno = $request->manpartno;
        $updateData->discountallowed = $request->discountallowed;
        $updateData->cashdis = $request->cashdis;
        $updateData->saleprice = $request->saleprice;
        $updateData->wsaleprice = $request->wsaleprice;
        $updateData->reorder = $request->reorder;
        $updateData->qty = $request->qty;
        $updateData->maxqty = $request->maxqty;
        $updateData->cost = $request->cost;
        $updateData->user_id = Auth::user()->id;   

            if($request->hasFile('file')){
        $productPhoto = $request->file('file');
        $filename = time() . '.' . $productPhoto->getClientOriginalExtension();
        Image::make($productPhoto)->resize(400, 400)->save(public_path('/electronic/' . $filename));
        $oldPhoto = $updateData->photo;
        //updateimg
        $updateData->photo = $filename;
        //delet img
             if ($oldPhoto)
            Storage::delete($oldPhoto);
            }

        $updateData ->save();


        return ['message' => 'Company Setting successfully Updated'];
    }

    public function SearchCode(request $request){
       
        if ($request->ajax())
        {
            $products = Electronicproduct::select('id','code')->where('code','=', $request->code)->count();
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

}
