<?php

namespace App\Http\Controllers\agents;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\modules\Agent;

use DB;

class AgentController extends Controller
{
    public function AgentsListGet()
    {
    	$agents = Agent::select('id','company','person','person2','tel','tel2','email','address','isActive')->paginate(50);
        return $agents->toArray();
    }
    public function AgentEdit($id)
    {
    	$agents = Agent::select('id','company','person','person2','tel','tel2','email','address','isActive')->find($id);
        return $agents->toArray();
    }
    public function AgentED($id)
    {
    	DB::table('agents')->where('id', $id)->update(['isActive' => 0]);

    	return ['message' => 'Agent successfully Updated'];
    }
    public function AgentUpdate(Request $request, $id)
    {
    	 $Agents = Agent::find($id);

    	 $Agents->update($request->all());

    	return ['message' => 'Agent successfully Updated'];

    }
    public function AgentSearch(request $request)
    {   
        $search = $request->search;
        $agents = Agent::where('company','LIKE', "%$search%")
        ->orwhere('person','LIKE', "%$search%")
        ->orwhere('person2','LIKE', "%$search%")
        ->orwhere('mobile','LIKE', "%$search%")
        ->orwhere('tel','LIKE', "%$search%")
        ->paginate(50);
        return $agents->toArray();    
    }
    public function AgentStore(Request $request)
    {
 		$this->validate($request, [
 			'company' => 'required',
 			'person' => 'required',
 			'mobile' => 'required',
 			'tel' => 'required',
 			'address' => 'required'
 		]);

		$Agent = new Agent();
        $Agent->company = $request->company;
        $Agent->person = $request->person;
        $Agent->person2 = $request->person2;
        $Agent->mobile = $request->mobile;
        $Agent->tel = $request->tel;
        $Agent->tel2 = $request->tel2;
        $Agent->email = $request->email;
        $Agent->address = $request->address;
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
 