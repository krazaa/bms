<?php

namespace App\Http\Controllers\stocks;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\modules\ElecStock; 

class ElecStockController extends Controller
{
    public function GetStock()
    {
    	$data = ElecStock::select('id','cost','selling','qty','tax','branch_id','poid','product_id')->with('products:id,name,code,qty,manpartno,cost')
    	->with('pos:id,poid,refno,podate')->with('branches:id,name,code')->get();

    	return $data->toArray();
    }
}
