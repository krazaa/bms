<?php

namespace App\Http\Controllers\settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Branch;

class BranchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Settings.branches.branches');
    }

    public function GetBranches()
    {
        $branches = Branch::get();
        return $branches;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Settings.branches.newbranch');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $branch = new Branch();
        $branch->name = $request->name;
        $branch->code = $request->code;
        $branch->address = $request->vendor_id;
        $branch->contact = $request->contact;
        $branch->mobile = $request->mobile;
        $branch->email = $request->email;
        $branch->city = $request->city;
        $branch ->save();
        
        return redirect('/dashboard')->with('success','Subject updated successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = $id;
        return view('settings.branches.editbranch' , compact('id'));
    }

    public function ShowSingle($id)
    {
        $branch = Branch::find($id);
        return $branch->toArray();    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function BranchUpdate(Request $request, $id)
    {
        $branch = Branch::findOrFail($id);  
        $branch ->update($request->all());
        $branch ->save();
        
        return redirect('/dashboard')->with('success','Subject updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = Branch::find($id);
        $products->delete();
        return back();
    }
}
