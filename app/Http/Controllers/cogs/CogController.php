<?php

namespace App\Http\Controllers\cogs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\modules\Cogacctye;
use App\modules\Cogcategory;
use App\modules\Cogas;
use Validator;
use DB;

class CogController extends Controller
{
    public function AcCheck(request $request)
    {
         if ($request->ajax())
        {
            $vendors = Cogas::where('acode', '=', $request->code)->count();
                if($vendors) {
                    $count = 'Not Available';
                    return Response($count);
                } else {
                    $count = 'Available';
                return Response($count);
            }
        }
    }
    public function CogsList()
    {
    	$cogs = Cogas::leftjoin('cogacctypes','cogacctypes.id','=' ,'cogas.actype_id')
    	->leftjoin('cogcategories','cogcategories.id','=' ,'cogas.acat_id')
    	->select('cogas.id','cogas.acode','cogas.aname','cogas.incom_balance_id','cogacctypes.name as tname','cogcategories.name as cname',
    			DB::raw('(CASE 
                        WHEN cogas.incom_balance_id = "1" THEN "Income Statement" 
                        WHEN cogas.incom_balance_id = "2" THEN "Balance Sheet" 
                        ELSE "" 
                        END) AS incmbal'),
    			DB::raw('(CASE 
                        WHEN cogas.debitcredit = "1" THEN "Both" 
                        WHEN cogas.debitcredit = "2" THEN "Debit" 
                        WHEN cogas.debitcredit = "3" THEN "Credit" 
                        ELSE "" 
                        END) AS debitcredit'))
    	->paginate(50); 
    	return response()->json($cogs);
    }

    public function AcCat()
    {
    	return response(Cogcategory::all());
    }
    public function AcTypes()

    {
    	return response(Cogacctye::all());
    }

    public function GetMainAcc()
    {
    	return response(Cogas::select('id','aname')->where('typeid','=', false)->where('subtype','=', false)->get());
    }

    public function GetSubAcc(Request $req)
    {
    	return response(Cogas::select('id','aname','typeid')->where('typeid', '>', '0')->where('subtype','=', $req->type)->get());
    }
    public function CogStoreAcc(Request $request)
    {
 		$this->validate($request, [
 			'search' => 'required',
 			'aname' => 'required'
 		]);

		$Cogas = new Cogas();
        $Cogas->acode = $request->search;
        $Cogas->aname = $request->aname;
        $Cogas->typeid = $request->typeid;
        if($request->has('subtype')) {
        	$Cogas->subtype = $request->subtype;
    	} else {
        	$Cogas->subtype = 0;
    		}
        $Cogas->subtype = $request->subtype;
        $Cogas->incom_balance_id = $request->inbal;
        $Cogas->acat_id = $request->acat_id;
        $Cogas->debitcredit = $request->debitcredit;
        $Cogas->actype_id = $request->actype;
        $Cogas ->save();

    	return ['message' => 'Record successfully added'];
    }
}
