<?php

namespace App\Http\Controllers\banks;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\modules\Bank;
use DB;

class BanksController extends Controller
{
     public function banksListGet()
    {
    	$banks = Bank::select('id','account','bank','iban','branchcode','mobile','phone','address','city','isActive')->paginate(50);
        return $banks->toArray();
    }
    public function BankEdit($id)
    {
    	$banks = Bank::select('id','account','bank','iban','branchcode','mobile','phone','address','city','isActive')->find($id);
        return $banks->toArray();
    }
    public function BankED($id)
    {
    $bank = Bank::find($id);

        if($bank->isActive == 1)
             { 
                DB::table('banks')->where('id', $id)->update(['isActive' => 0]);
             
             }elseif ($bank->isActive == 0) {
                 DB::table('banks')->where('id', $id)->update(['isActive' => 1]);
             }

    	return ['message' => 'bank successfully Updated'];
    }
    public function bankUpdate(Request $request, $id)
    {
    	 $banks = Bank::find($id);

    	 $banks->update($request->all());

    	return ['message' => 'bank successfully Updated'];

    }
    public function BankSearch(request $request)
    {   
        $search = $request->search;
        $banks = Bank::where('bank','LIKE', "%$search%")
        ->orwhere('account','LIKE', "%$search%")
        ->orwhere('city','LIKE', "%$search%")
        ->orwhere('branchcode','LIKE', "%$search%")
        ->paginate(50);
        return $banks->toArray();    
    }
    public function BankStore(Request $request)
    {
 		$this->validate($request, [
 			'bank' => 'required',
 			'account' => 'required',
 			'branchcode' => 'required',
 			'phone' => 'required',
 			'address' => 'required',
 			'city' => 'required'
 		]);

		$bank = new Bank();
        $bank->bank = $request->bank;
        $bank->account = $request->account;
        $bank->iban = $request->iban;
        $bank->branchcode = $request->branchcode;
        $bank->phone = $request->phone;
        $bank->mobile = $request->mobile;
        $bank->city = $request->city;
        $bank->address = $request->address;
        $bank ->save();

    	return ['message' => 'Bank successfully Stored'];
    }
    public function AvailabilityCheck(request $request)
    {
         if ($request->ajax())
        {
            $checkstatus = Bank::where('account', '=', $request->account)->count();
                if($checkstatus) {
                    $count = 'Not Available';
                    return Response($count);
                } else {
                    $count = 'Available';
                return Response($count);
            }
        }
    }
    public function bankDelete($id)
    {
    	$data = Bank::find($id)->delete();
    	return ['message' => 'bank successfully Deleted'];
	}
}
 