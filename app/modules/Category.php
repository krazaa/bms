<?php

namespace App\modules;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

	 protected $fillable = [
        'id','type', 'category', 'ctype', 'sub_id', 'isActive'
    ];

    public function subcats()
    {
        return $this->hasMany('App\Subcat');
        //return $this->belongsToMany('App\Branch', 'branch_user', 'branch_id', 'user_id');
    }

    public function catsubs()
    {
        return $this->belongsTo(Category::class, 'sub_id');
     
    }

     public function scopeActive($query)
    {
        return $query->where('isActive', 1);
    }

    protected $dates = [
            'created_at',
            'updated_at',
            'deleted_at'
        ];

}
