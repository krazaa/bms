<?php

namespace App\Http\Controllers\ledgers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Purchase;

class LedgersController extends Controller
{
    public function AccountPayableLedger()
    {
    	$data = Purchase::where('account_id',60)->get();

    	dd($data);
    }
}
