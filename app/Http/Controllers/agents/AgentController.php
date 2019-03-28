<?php

namespace App\Http\Controllers\agents;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\modules\Agent;
use DB;

class AgentController extends Controller
{
    // public function __construct()
    // {
    // $this->middleware('auth');
    // }
    
    public function AgentsListGet()
    {
        $agents = Agent::select('id','company','person','cnic','tel','mobile','email','baddress','haddress','isActive','city')->orderBy('id','desc')->paginate(20);
        return $agents->toArray();
    }

    public function AgentEdit($id)
    {
    	$agents = Agent::find($id);
        return $agents->toArray();
    }

    public function AgentED($id)
    {
    $agent = Agent::find($id);

        if($agent->isActive == 1)
             { 
                DB::table('agents')->where('id', $id)->update(['isActive' => 0]);
             
             }elseif ($agent->isActive == 0) {
                 DB::table('agents')->where('id', $id)->update(['isActive' => 1]);
             }

    	return ['message' => 'Agent successfully Updated'];
    }

    public function AgentUpdate(Request $request, $id)
    {
    	 
         $Agents = Agent::find($id);
    	 $Agents->update($request->all());

    return response()->json(['message' => 'This request succeeded.'], 200);

    }
    public function AgentSearch(request $request)
    {   
        $search = $request->search;
        $agents = Agent::where('company','LIKE', "%$search%")
        ->orwhere('person','LIKE', "%$search%")
        ->orwhere('cnic','LIKE', "%$search%")
        ->orwhere('mobile','LIKE', "%$search%")
        ->orwhere('tel','LIKE', "%$search%")
        ->orderBy('id','desc')
        ->paginate(20);
        return $agents->toArray();    
    }

    public function AgentStore(Request $request)
    {
 		$this->validate($request, [
 			'company' => 'required',
 			'person' => 'required',
 			'mobile' => 'required',
 			'tel' => 'required',
 			'baddress' => 'required'
 		]);

		$Agent = new Agent();
        $Agent->company = $request->company;
        $Agent->person = $request->person;
        $Agent->cnic = $request->cnic;
        $Agent->mobile = $request->mobile;
        $Agent->tel = $request->tel;
        $Agent->haddress = $request->haddress;
        $Agent->email = $request->email;
        $Agent->baddress = $request->baddress;
        $Agent->city = $request->city;
        $Agent->isActive = 1;
        $Agent ->save();

    	return ['message' => 'Agent successfully Stored'];
    }

    public function AvailabilityCheck(request $request)
    {
         if ($request->ajax())
        {
            $checkstatus = Agent::where('company', '=', $request->company)->count();
                if($checkstatus) {
                    $count = 'Not Available';
                    return Response($count);
                } else {
                    $count = 'Available';
                return Response($count);
            }
        }
    }
    
    public function AgentDelete($id)
    {
    	$data = Agent::find($id)->delete();
    	return ['message' => 'Agent successfully Deleted'];
	}
}
 