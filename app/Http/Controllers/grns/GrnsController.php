<?php

namespace App\Http\Controllers\grns;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\modules\Purchaseorder;


class GrnsController extends Controller
{
     public function GetGrn($id)
    {
      $data = Purchaseorder::leftjoin('elecstocks','elecstocks.po_id','=','purchaseorders.poid')
      		->leftjoin('vendors','vendors.id','=','elecstocks.vendor_id')
    		->leftjoin('vendors as trans','trans.id','=','elecstocks.cargo_id')
      		->leftjoin('electronicproducts as products','products.id','=','elecstocks.product_id')
      		->leftjoin('categories','categories.id', '=', 'products.category_id')
      		->leftjoin('categories as sub','sub.id', '=', 'products.subcategory_id')
  
        	  ->select('elecstocks.qty','elecstocks.cost','elecstocks.cargopu','elecstocks.cargoamount','elecstocks.tax','elecstocks.ddate','elecstocks.rdate','elecstocks.duedate','purchaseorders.podate','elecstocks.dno','elecstocks.stinv','purchaseorders.poid','vendors.company','vendors.contact','vendors.address','trans.company as transporter','products.code','products.name','products.manpartno','categories.category','sub.category as subcat')
        ->where('purchaseorders.poid','=',$id)
		->where('purchaseorders.stockReceive', false)
        ->groupBy('elecstocks.product_id')
        ->get();

        return $data;    
    }

    public function GrnsList()
    {
        $data = DB::table('purchaseorders')->leftjoin('branches','branches.id','=','purchaseorders.branch_id')
        ->select('purchaseorders.id','purchaseorders.type','purchaseorders.refno','purchaseorders.poid','purchaseorders.podate','purchaseorders.branch_id','branches.name')
        ->where('purchaseorders.stockReceive',false)
        ->orderBy('purchaseorders.poid','desc')
        ->groupBy('purchaseorders.poid')
        ->get();

        return $data;    
    }
}
