<?php

namespace App\Http\Controllers\reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Purchase;
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
}
