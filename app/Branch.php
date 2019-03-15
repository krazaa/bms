<?php

namespace App;
use Laratrust\LaratrustBranch;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\User');
        //return $this->belongsToMany('App\Branch', 'branch_user', 'branch_id', 'user_id');
    }
}
