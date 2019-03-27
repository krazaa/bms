<?php

namespace App\modules;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

	 protected $fillable = [
        'type', 'category', 'ctype', 'sub_id', 'isActive'
    ];

    public function subcats()
    {
        return $this->hasMany('App\Subcat');
        //return $this->belongsToMany('App\Branch', 'branch_user', 'branch_id', 'user_id');
    }
}
