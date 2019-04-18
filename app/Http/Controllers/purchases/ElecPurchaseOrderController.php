<?php

namespace App\Http\Controllers\purchases;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\modules\Purchaseorder;
use App\modules\Electronicproduct;
use App\modules\ElecStock;
use App\Branch;
use App\Payment;
use App\Purchase;
use Auth;
use DB;
use PDF;
use Carbon\Carbon;
class ElecPurchaseOrderController extends Controller
{

	public function GetElecProducts(Request $request)
	{
        $search = $request->search;
        $data = Electronicproduct::select('id','name','code','photo')
        ->where('name','LIKE', "%$search%")
        ->orwhere('code','LIKE', "%$search%")
        ->orderBy('id','desc')
        ->take(5)->get();
        //->paginate(5);
        return $data->toArray(); 
	}

        public function ElecProductsList()
    {
        
        $data = Electronicproduct::select('id','name','code')
        ->orderBy('id','desc')
        ->get();
        //->paginate(5);
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
        ->where('purchaseorders.stockReceive',true)
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
        ->select('vendors.company','vendors.address','vendors.contact','vendors.mobile','purchaseorders.id','purchaseorders.isActive','purchaseorders.refno','purchaseorders.qty','purchaseorders.podate','purchaseorders.product_id','purchaseorders.branch_id','purchaseorders.vendor_id','purchaseorders.poid','branches.name as branch','electronicproducts.code','electronicproducts.name','categories.category','sub.category as subcat','electronicproducts.cost','electronicproducts.wsaleprice','electronicproducts.saleprice')
        ->where('purchaseorders.poid','=',$id)
        ->where('purchaseorders.stockReceive',true)
        ->orderBy('purchaseorders.poid','desc')
        ->get();

        return $data;    
    }



    public function GetPOshowPDF($id)
    {
        $data = DB::table('purchaseorders')
        ->leftjoin('vendors','vendors.id','=','purchaseorders.vendor_id')
        ->leftjoin('branches','branches.id','=','purchaseorders.branch_id')
        ->leftjoin('electronicproducts','electronicproducts.id','=','purchaseorders.product_id')
        ->leftjoin('categories','categories.id', '=', 'electronicproducts.category_id')
        ->leftjoin('categories as sub','categories.id', '=', 'electronicproducts.subcategory_id')
        ->select('vendors.company','vendors.address','vendors.contact','vendors.mobile','purchaseorders.id','purchaseorders.isActive','purchaseorders.refno','purchaseorders.qty','purchaseorders.podate','purchaseorders.product_id','purchaseorders.poid','branches.name as branch','electronicproducts.code','electronicproducts.name','categories.category','sub.category as subcat')
        ->where('purchaseorders.poid','=',$id)
        ->where('purchaseorders.stockReceive',true)
        ->orderBy('purchaseorders.poid','desc')
        
        ->get();
        $pdf = PDF::loadView('pdfs.poshow', compact('data'));
        return $pdf->stream('po.pdf');
        
    }

        public function ReceivePOStore(Request $request)
        {
            

        $data = $request->all();
             $finalArray = array();

         foreach($data as $key=>$value){

            array_push($finalArray, 
            array(
                'vendor_id'=>$request[0]['vendor_id'],
                'po_id'=>$request[0]['poid'],
                'cargoamount'=>$request[0]['cargoStore'],
                'dno'=>$request[0]['dno'],
                'stinv'=>$request[0]['stinv'],
                'ddate'=>$request[0]['ddate'],
                'rdate'=>$request[0]['rdate'],
                'duedate'=>$request[0]['duedate'],
                'tax'=>$request[0]['tax'],
                'branch_id'=>$request[0]['branch_id'],
                'cargo_id'=>$request[0]['trans_id'],
                'product_id'=>$value['product_id'],
                'cargo_id'=>$value['trans_id'],
                'qty'=>$value['qty'],
                'cost'=>$value['cost'],
                'cargopu'=>$value['cargopu'],
                'CostAmount'=>$value['cgt'],
                'wolSale'=>$value['wolSale'],
                'salPrice'=> $value['salPrice'] )
                );
        }
    ElecStock::insert($finalArray);

    DB::table('purchaseorders')->where('poid', $request[0]['poid'])->update(['stockReceive' => 0]);

    $tax = new Purchase();
    $tax->account_id = 56;
    $tax->po_id = $request[0]['poid'];
    $tax->vendor_id = $request[0]['vendor_id'];
    $tax->product_id = $request[0]['product_id'];
    $tax->dr = $request[0]['tax'];
    $tax->date_at = Carbon::now();
    $tax->save();

    $Payable = new Purchase();
    $Payable->account_id = 60;
    $Payable->po_id = $request[0]['poid'];
    $Payable->vendor_id = $request[0]['vendor_id'];
    $Payable->product_id = $request[0]['product_id'];
    $Payable->cr = $request[0]['cgt'] + $request[0]['tax'];;
    $Payable->date_at = Carbon::now();
    $Payable->save();

    $INVENTORY = new Purchase();
    $INVENTORY->account_id = 5;
    $INVENTORY->po_id = $request[0]['poid'];
    $INVENTORY->vendor_id = $request[0]['vendor_id'];
    $INVENTORY->product_id = $request[0]['product_id'];
    $INVENTORY->dr = $request[0]['cgt'];
    $INVENTORY->date_at = Carbon::now();
    $INVENTORY->save();

    $cargo = new Purchase();
    $cargo->account_id = 60;
    $cargo->po_id = $request[0]['poid'];
    $cargo->vendor_id = $request[0]['trans_id'];
    $cargo->product_id = $request[0]['product_id'];
    $cargo->dr = $request[0]['cargopo'];
    $cargo->date_at = Carbon::now();
    $cargo->save();

    

    // $Purchase = new Purchase();
    // $Purchase->product_id =$request[0]['product_id'];
    // $Purchase->vendor_id =$request[0]['vendor_id'];
    // $Purchase->rate =$request[0]['rate'];
    // $Purchase->qty =$request[0]['qty'];
    // $Purchase->tax =$request[0]['tax'];
    // $Purchase->date_at = Carbon::now();

    // $Purchase = $request->all();
    //          $PurchasefinalArray = array();

    //      foreach($Purchase as $key=>$value){

    //         array_push($PurchasefinalArray, 
    //         array(
    //             'vendor_id'=>$request[0]['vendor_id'],
    //             'tax'=>$request[0]['tax'],
    //             'date_at'=>Carbon::now(),
    //             'qty'=>$value['qty'],
    //             'product_id'=>$value['product_id'],
    //             'rate'=>$value['CostAmount'])
                
    //             );
    //     }
    // Purchase::insert($PurchasefinalArray);


        //     for($i=0;$i<count($request[0]['id']);$i++){

        //     $Data = new ElecStock();
        //     $Data->vendor_id = $request[0]['vendor_id'];
        //     $Data->poid = $request[0]['id'];
        //     $Data->cargoamount = $request[0]['cargoamount'];
        //     $Data->dno = $request[0]['dno'];
        //     $Data->stinv = $request[0]['stinv'];
        //     $Data->ddate = $request[0]['ddate'];
        //     $Data->rdate = $request[0]['rdate'];
        //     $Data->duedate = $request[0]['duedate'];
        //     $Data->tax = $request[0]['tax'];
        //     $Data->branch_id = $request[0]['branch_id'];
        //     $Data->product_id = $request[0]['product_id'];
        //     $Data->qty = $request[0]['qty'][$i];
        //     $Data->CostAmount = $request[0]['CostAmount'][$i];
        //     $Data->wolSale = $request[0]['wolSale'][$i];
        //     $Data->salPrice = $request[0]['salPrice'][$i];
        // }
            
        //     $Data->save();
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
