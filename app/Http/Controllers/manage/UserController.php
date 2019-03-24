<?php

namespace App\Http\Controllers\manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Branch;
use App\Role;
use DB;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function Getusers()
    {
        $users = User::paginate(50); 
        return $users->toArray();
    }

    public function GetSingleUser($id)
    {
        $users = User::with('roles')->find($id);
        return $users->toArray();
    }

    public function StautsChange($id)
    {
    $user = USer::find($id);

        if($user->isActive == 1)
             { 
                DB::table('users')->where('id', $id)->update(['isActive' => 0]);
             
             }elseif ($user->isActive == 0) {
                 DB::table('users')->where('id', $id)->update(['isActive' => 1]);
             }

        return ['message' => 'user successfully Updated'];
    }

    public function GetBranches()
    {
        $branches = Branch::all();
        return $branches->toArray();
    }

    public function GetRoles()
    {
        $roles = Role::all();
        return $roles->toArray();
    }

     public function UserSearch(request $request)
    {   
        $search = $request->search;
        $agents = User::where('name','LIKE', "%$search%")
        ->orwhere('email','LIKE', "%$search%")
        ->paginate(50);
        return $agents->toArray();    
    }

    public function SearchUsers(request $request)
    {
        $search = $request->search; 

        $user = User::where('name','=', $search)->get();
        if($user)
        {
            $user = 'Not Available';
        } else {
            $user = 'Available';
        }
        return $user;
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //return $request->all();

        $this->validate($request, [
        'name' => 'required|max:255',
        'email' => 'required|email|unique:users'
      ]);

      if (!empty($request->password)) {
        $password = trim($request->password);
      } else {
        # set the manual password
        $length = 10;
        $keyspace = '123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
        $str = '';
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $str .= $keyspace[random_int(0, $max)];
        }
        $password = $str;
      }

      $user = new User();
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = Hash::make($password);
      $user->save();

    if ($request->roleId) {
        $user->roles()->attach($request->roleId);
      }

    if ($request->branchId) {
        $user->branches()->attach($request->branchId);
      }

      // return redirect()->route('manage.users');
      //return redirect()->route('manage.users', $user->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = $id;
        return view('manage.users.show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function UserDelete($id)
    {
        $data = User::find($id)->delete();
        return ['message' => 'User successfully Deleted'];
    }
}
