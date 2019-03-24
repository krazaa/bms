<?php

namespace App\Http\Controllers\manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Permission;
class PermissionController extends Controller
{
     public function index()
    {
        $Permission = Permission::all(); 
        return $Permission->toArray();
    }
}
