<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $guarded = ['id'];

     public function accounts()
    {
        return $this->belongsTo('App\modules\Cogas', 'account_id');
        
    }

     public function vendors()
    {
        return $this->belongsTo('App\modules\Vendor', 'vendor_id');
        
    }

     public function products()
    {
        return $this->belongsTo('App\modules\Electronicproduct', 'product_id');
        
    }

     public function ponumbers()
    {
        return $this->belongsTo('App\modules\Purchaseorder', 'po_id');
        
    }
     
}
