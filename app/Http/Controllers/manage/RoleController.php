<?php

namespace App\Http\Controllers\manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\Permission;
class RoleController extends Controller
{
     public function index()
    {
        $roles = Role::all(); 
        return $roles->toArray();
    }

    public function RoleEdit($id)
    {
    	$role = Role::where('id', $id)->with('permissions')->first();
      	$permissions = Permission::all();
        return $role->withRole($role)->toArray();
    }
}
