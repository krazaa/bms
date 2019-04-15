<?php

namespace App\Http\Controllers\reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Purchase;
use App\modules\ElecStock;
use DB;

class ReportsController extends Controller
{
     public function CogABR()
    {
        $cats = Purchase::select('*',
        		DB::raw('SUM(purchases.dr) as debit'),
        		DB::raw('SUM(purchases.cr) as credit')
        	)
        		->with('accounts')
        		->groupby('account_id')
        		->get();
    return $cats;

	}

        public function itaxledger()
    {
        $cats = Purchase::select('*',
                DB::raw('SUM(purchases.dr) as debit'),
                DB::raw('SUM(purchases.cr) as credit'))
                ->where('purchases.account_id','=',56)
                ->with('accounts')->with('vendors')->with('products')->with('ponumbers')
                ->groupby('po_id')
                ->get();
    return $cats;

    }

    public function inventAccledger()
    {
        $cats = Purchase::select('*',
                DB::raw('SUM(purchases.dr) as debit'),
                DB::raw('SUM(purchases.cr) as credit'))
                ->where('purchases.account_id','=',56)
                ->with('accounts')->with('vendors')->with('products')->with('ponumbers')
                ->groupby('po_id')
                ->get();
    return $cats;

    }

    public function IVS()
    {
        $cats = ElecStock::leftjoin('electronicproducts','electronicproducts.id','=', 'elecstocks.product_id')
        ->select('elecstocks.id','elecstocks.salPrice','electronicproducts.name','elecstocks.cost','elecstocks.wolSale',
        DB::raw('SUM(elecstocks.qty) as qty'))
        ->groupby('elecstocks.product_id')
                ->get();
    return $cats;

    }
}
