<?php

namespace App\modules;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $guarded = ['id'];

    protected $dates = [
            'created_at',
            'updated_at',
            'deleted_at'
        ];

     public function brands()
    {
        return $this->belongsTo('App\modules\Brand', 'brand_id');
     
    }
    
    public function scopeActive($query)
    {
        return $query->where('isActive', true);
    }

     public function accounts()
    {
        return $this->belongsTo('App\Purchase', 'vendor_id');
    }
}
