<?php

namespace App\modules;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $guarded = ['id'];

     public function brands()
    {
        return $this->belongsTo('App\modules\Brand', 'brand_id');
     
    }
    
    public function scopeActive($query)
    {
        return $query->where('isActive', true);
    }
}
