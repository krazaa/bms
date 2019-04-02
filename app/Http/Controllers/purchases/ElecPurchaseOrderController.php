<?php

namespace App\Http\Controllers\purchases;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\modules\Purchaseorder;
use App\modules\Electronicproduct;
use App\Branch;
use Auth;

class ElecPurchaseOrderController extends Controller
{

	public function GetElecProducts(Request $request)
	{
        $search = $request->search;
        $data = Electronicproduct::select('id','name','code','photo')
        ->where('name','LIKE', "%$search%")
        ->orwhere('code','LIKE', "%$search%")
        ->orderBy('id','desc')
        //->get();
        ->paginate(5);
        return $data->toArray(); 
	}

	public function GetBranches()
	{
		$data = Branch::select('id','name')->get();
		return $data->toArray();	
	}


    public function GetPOList()
    {
    	$data = Purchaseorder::leftjoin('vendors','vendors.id','=','purchaseorders.vendor_id')
        ->leftjoin('branches','branches.id','=','purchaseorders.branch_id')
    	->select('vendors.company','purchaseorders.isActive','purchaseorders.cost','purchaseorders.refno','purchaseorders.podate','purchaseorders.selling','purchaseorders.statusPaid','purchaseorders.poid','branches.name as branch')
        ->orderBy('purchaseorders.poid','desc')
    	->paginate(15);

    	return $data->toArray();	
    }

        public function StatusChange($id)
    {
    	$data = Purchaseorder::find($id);

        if($data->isActive == 1)
             { 
                DB::table('purchaseorders')->where('id', $id)->update(['isActive' => 0]);
             
             }elseif ($data->isActive == 0) {
                 DB::table('purchaseorders')->where('id', $id)->update(['isActive' => 1]);
             }

        return ['message' => ' successfully Updated'];
    }	

    	public function StoreElecPO(Request $request)
    		{

            return $request->all();
        // //          $this->validate($request, [
        // //     //'code' => 'required|unique:electronicproducts',
        // //     'vendor_id' => 'required',
        // //     'poid' => 'required',
        // //     'refno' => 'required',
        // //     'podate' => 'required',
        // //     'qty' => 'required',
        // //     'product_id' => 'required',
        // //     'branch_id' => 'required'
            
        // // ]);
    			
            $pon = Purchaseorder::orderBy('id', 'desc')->first();
    			if ( ! $pon )
        		      $number = 0;
    		      else 
        	$number = substr($pon->poid, 6);
        	$ponum =  sprintf('%08d', intval($number) + 1);

             //for($i=0;$i<count($request['vendor_id']);$i++)

        
//        {


            $Data = new Purchaseorder();
            
            $Data->vendor_id = $request->vendor_id;
            $Data->poid = $ponum;
            $Data->type = 2;
            $Data->refno = $request->refno;
            $Data->podate = $request->podate;
            $Data->qty = $request->qty;
            $Data->product_id = $request->product_id;
            $Data->branch_id = $request->branch_id;
            $Data->user_id = Auth::user()->id;
            $Data->save();
         }              


    public function RecordDelete($id)
    {
        // $autos = Purchaseorder::where('vendor_id',$id)->count();
        //     if($autos) {
        //         return ['message' => 'Vendor is not empty'];
        //        } else {
        //         $count = Vendor::find($id)->delete();
        //         return ['message' => 'Successfully Deleted'];
        //     }

        $data = Purchaseorder::find($id)->delete();
        return ['message' => ' successfully Deleted'];
    }
}
