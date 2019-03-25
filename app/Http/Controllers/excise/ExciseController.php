<?php

namespace App\Http\Controllers\excise;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\modules\Excise;
use App\modules\Agent;
use DB;
class ExciseController extends Controller
{
   public function ExciseListGet()
    {
    	$data = Excise::leftjoin('agents','agents.id','=', 'excises.agent_id')
    	->select('excises.id','excises.office','excises.model','excises.agent_id','excises.cost','excises.selling','excises.isActive','agents.company','agents.person')->paginate(50);
        return $data->toArray();
    }
    public function GetAgents()
    {
    	$data = Agent::all();
        return $data->toArray();
    }
    public function ExciseEdit($id)
    {
    	$data = Excise::select('id','office','model','agent_id','cost','selling','isActive')->find($id);
        return $data->toArray();
    }
    public function ExciseED($id)
    {
    $data = Excise::find($id);

        if($data->isActive == 1)
             { 
                DB::table('excises')->where('id', $id)->update(['isActive' => 0]);
             
             }elseif ($data->isActive == 0) {
                 DB::table('excises')->where('id', $id)->update(['isActive' => 1]);
             }

    	return ['message' => 'Excise and Taxation Office successfully Updated'];
    }
    public function ExciseUpdate(Request $request, $id)
    {
    	 $data = Excise::find($id);

    	 $data->update($request->all());

    	return ['message' => 'Excise and Taxation Office successfully Updated'];

    }
    public function ExciseSearch(request $request)
    {   
        $search = $request->search;
        $data = Excise::leftjoin('agents','agents.id','=', 'excises.agent_id')
    	->select('excises.id','excises.office','excises.model','excises.agent_id','excises.cost','excises.selling','excises.isActive','agents.company','agents.person')
        ->where('excises.office','LIKE', "%$search%")
        ->orwhere('excises.model','LIKE', "%$search%")
        ->orwhere('agents.company','LIKE', "%$search%")
        ->orwhere('agents.person','LIKE', "%$search%")
        ->orwhere('model','LIKE', "%$search%")
        ->paginate(50);
        return $data->toArray();    
    }
    public function ExciseStore(Request $request)
    {
 		$this->validate($request, [
 			'office' => 'required',
 			'model' => 'required',
 			'agent_id' => 'required',
 			'cost' => 'required',
 			'selling' => 'required'
 		]);

		$data = new Excise();
        $data->office = $request->office;
        $data->model = $request->model;
        $data->agent_id = $request->agent_id;
        $data->cost = $request->cost;
        $data->selling = $request->selling;
        $data ->save();

    	return ['message' => 'Bank successfully Stored'];
    }
    public function AvailabilityCheck(request $request)
    {
         if ($request->ajax())
        {
            $checkstatus = Excise::where('account', '=', $request->account)->count();
                if($checkstatus) {
                    $count = 'Not Available';
                    return Response($count);
                } else {
                    $count = 'Available';
                return Response($count);
            }
        }
    }
    public function ExciseDelete($id)
    {
    	$data = Excise::find($id)->delete();
    	return ['message' => 'Excise and Taxation Office successfully Deleted'];
	}
}
 