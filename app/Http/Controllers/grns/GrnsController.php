<?php

namespace App\Http\Controllers\grns;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\modules\Purchaseorder;
use App\modules\ElecStock;
use PDF;
use Excel;


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

    public function GetGrnpdf($id)
    {
    
      $data = ElecStock::select('*',
      DB::raw('SUM(cost * qty) as totalcost'),
      DB::raw('SUM(cargopu * qty) as cargo'),
      DB::raw('SUM(cost * qty) as atc'))
      ->where('po_id','=',$id)
		//->where('stockReceive', false)
    ->with('products')
    ->with('vendors')
      ->groupBy('id')
        ->get();

        /////dd($data);
        //return view('pdfs.grnepdf', compact('data')); 
        foreach ($data as $key =>  $row)
        $pdf = PDF::loadView('pdfs.grnepdf', compact('data'))->setPaper('legal', 'landscape');
        return $pdf->stream($row->po_id);  
        
    }

    public function GrnsList()
    {
        $data = ElecStock::
        select('*',
      DB::raw('SUM(cost * qty) as totalcost'),
      DB::raw('SUM(cargopu * qty) as cargo'))
        //->where('stockReceive',false)
        ->orderBy('po_id','desc')
        ->groupBy('po_id')->with('vendors:id,company')->with('pos:id,podate,poid,type,refno,isPaid')
        ->get();

        
        
        return $data;    
    }
/////// Excel Export
      public function GrneExcel($id)
    {
       $datas = ElecStock::select('*',
      DB::raw('SUM(cost * qty) as totalcost'),
      DB::raw('SUM(cargopu * qty) as cargo'),
      DB::raw('SUM(cost * qty + cargopu) as atc'))
      ->where('po_id','=',$id)
      //->where('stockReceive', false)
      ->with('products')
      ->with('vendors')
      ->groupBy('id')
      ->get();

      
      $GrnData ="";

      if(count($datas) > 0 ) {
        $GrnData .= '<table>
        <tr>
        <th>Vendor</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Transporter Name</th>
        <th>Transportaton</th>
        <th>Order Date</th>
        <th>Dispatch Date</th>
        <th>Receiving Date</th>
        <th>Due Date</th>
        <th>Income Tax</th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        </tr>';

        $GrnData .= '<table>
        <tr>
        <th>Po order no</th>
        <th>Delivery no</th>
        <th>sales tax inv no</th>
        <th>PO Status</th>
        <th>Payable vendor</th>
        </tr>';

        foreach($datas as $data){
          $GrnData .='
          <tr>
          <td>'.$data->vendors->company.'</td>
          <td>'.$data->vendors->address.'</td>
          <td>'.$data->vendors->contact.'</td>
          <td>'.$data->cvendors->company.'</td>
          <td>'.number_format($datas->sum('cargo'),2).'</td>
          </tr>';

          $GrnData .='
          <tr>
          <td>'.$data->po_id.'</td>
          <td>'.$data->dno.'</td>
          <td>'.$data->stinv.'</td>
          <td>'.'Received'.'</td>
          <td>'.number_format($datas->sum('totalcost'),2).'</td>
          </tr>';
        }
        $GrnData .= '</table>';
      }
      header('Content-Type: application/xls');
      header('Content-Disposition: attachment; filename=GRN.xls');
      echo $GrnData;
    }
}
