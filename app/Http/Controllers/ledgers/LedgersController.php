<?php

namespace App\Http\Controllers\ledgers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Purchase;
use App\modules\Vendor;
use DB;

class LedgersController extends Controller
{
    public function AccountPayableLedger()
    {
    	$data = Purchase::where('account_id',60)->with('ponumbers:id,poid,podate', 'vendors:id,company')->get();

    	return $data;
    }

    public function VendorBalanceSummary()
    {
    	$data = purchase::select('*',
    	DB::raw('SUM(cr) as credit'))
    	->where('cr', '>', 0)
    	->with('vendors:id,company')
    	->groupBy('vendor_id')
    	->get();

    	return $data;
    }
}
