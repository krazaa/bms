<?php

namespace App\modules;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function subcats()
    {
        return $this->hasMany('App\Subcat');
        //return $this->belongsToMany('App\Branch', 'branch_user', 'branch_id', 'user_id');
    }
}
