<?php

namespace App\Http\Controllers\purchases;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\modules\Purchaseorder;
use App\modules\Electronicproduct;
use App\Branch;
use Auth;
use DB;
use PDF;

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
    	$data = DB::table('purchaseorders')
        ->leftjoin('vendors','vendors.id','=','purchaseorders.vendor_id')
        ->leftjoin('branches','branches.id','=','purchaseorders.branch_id')
    	->select('vendors.company','purchaseorders.id','purchaseorders.poid','purchaseorders.isActive','purchaseorders.refno','purchaseorders.podate','purchaseorders.statusPaid','purchaseorders.poid','branches.name as branch')
        ->orderBy('purchaseorders.poid','desc')
        ->groupby('purchaseorders.poid')
    	->paginate(15);

    	return $data->toArray();	
    }

    public function GetPOshow($id)
    {
        $data = DB::table('purchaseorders')
        ->leftjoin('vendors','vendors.id','=','purchaseorders.vendor_id')
        ->leftjoin('branches','branches.id','=','purchaseorders.branch_id')
        ->leftjoin('electronicproducts','electronicproducts.id','=','purchaseorders.product_id')
        ->leftjoin('categories','categories.id', '=', 'electronicproducts.category_id')
        ->leftjoin('categories as sub','categories.id', '=', 'electronicproducts.subcategory_id')
        ->select('vendors.company','vendors.address','vendors.contact','vendors.mobile','purchaseorders.id','purchaseorders.isActive','purchaseorders.refno','purchaseorders.qty','purchaseorders.podate','purchaseorders.statusPaid','purchaseorders.poid','branches.name as branch','electronicproducts.code','electronicproducts.name','categories.category','sub.category as subcat','electronicproducts.cost','electronicproducts.wsaleprice','electronicproducts.saleprice')
        ->where('purchaseorders.poid','=',$id)
        ->orderBy('purchaseorders.poid','desc')
        ->get();

        return $data->toArray();    
    }

    public function GetPOshowPDF($id)
    {
        $data = DB::table('purchaseorders')
        ->leftjoin('vendors','vendors.id','=','purchaseorders.vendor_id')
        ->leftjoin('branches','branches.id','=','purchaseorders.branch_id')
        ->leftjoin('electronicproducts','electronicproducts.id','=','purchaseorders.product_id')
        ->leftjoin('categories','categories.id', '=', 'electronicproducts.category_id')
        ->leftjoin('categories as sub','categories.id', '=', 'electronicproducts.subcategory_id')
        ->select('vendors.company','vendors.address','vendors.contact','vendors.mobile','purchaseorders.id','purchaseorders.isActive','purchaseorders.refno','purchaseorders.qty','purchaseorders.podate','purchaseorders.statusPaid','purchaseorders.poid','branches.name as branch','electronicproducts.code','electronicproducts.name','categories.category','sub.category as subcat')
        ->where('purchaseorders.poid','=',$id)
        ->orderBy('purchaseorders.poid','desc')
        ->get();
        $pdf = PDF::loadView('pdfs.poshow', compact('data'));
        return $pdf->stream('po.pdf');
        
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
                
                $pon = Purchaseorder::orderBy('id', 'desc')->first();
                if ( ! $pon )
                   $number = 0;
                    else 
                 $number = substr($pon->poid, 6);
                 $ponum =  sprintf('%08d', intval($number) + 1);

                
                // $data1 = $request->all();
                // // Purchaseorder::insert($data);

                // foreach ($data1 as $key =>$v)
                // {
                    

                // $data=array(
                //             $v,

                //           'poid'=>$ponum
                        
                //     );
                // //dd($data);
                //  Purchaseorder::insert($data);

                // }
                
                
                // }
/////////////////////////////////////////

 $data = $request->all();
         $finalArray = array();
         foreach($data as $key=>$value){
         array_push($finalArray, 
            array(
                'poid'=>$ponum,
                'vendor_id'=>$request[0]['vendor_id'],
                'podate'=>$request[0]['podate'],
                'refno'=>$request[0]['refno'],
                'type'=>2,
                'isActive'=>1,
                'user_id'=> Auth::user()->id,
                'product_id'=>$value['product_id'],
                'qty'=>$value['qty'],
                'branch_id'=> $value['branch_id'] )
     );
    }
    //    dd($finalArray);
    Purchaseorder::insert($finalArray);
}

/////////////////////////////////////////



            // $this->validate($request, [
            // //'code' => 'required|unique:electronicproducts',
            // 'vendor_id' => 'required',
            // 'poid' => 'required',
            // 'refno' => 'required',
            // 'podate' => 'required',
            // 'qty' => 'required',
            // 'product_id' => 'required',
            // 'branch_id' => 'required'
            
            // ]);


    			
       //      $pon = Purchaseorder::orderBy('id', 'desc')->first();
    			// if ( ! $pon )
       //  		      $number = 0;
    		 //      else 
       //  	$number = substr($pon->poid, 6);
       //  	$ponum =  sprintf('%08d', intval($number) + 1);

            // $vendor = json_decode($request[0]['vendor_id']);
            // $podate = json_decode($request[0]['podate']);
            // $refno = json_decode($request[0]['refno']);

            // $Data = new Purchaseorder();            
            // $Data->user_id = Auth::user()->id;
            // $Data->type = 2;
            // $Data->poid = $ponum;
            // $Data->vendor_id = $vendor;
            // $Data->podate = $podate;
            // $Data->refno = $refno;

            // $Data->qty = $request->qty;
            // $Data->branch_id = $request->branch_id;
            // $Data->product_id = $request->product_id;
            // $Data->save();
         
                //return $request->all();
     //}


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
