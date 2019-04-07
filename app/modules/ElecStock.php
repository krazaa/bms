<?php

namespace App\modules;

use Illuminate\Database\Eloquent\Model;

class ElecStock extends Model
{
    protected $table = 'elecstocks';


    public function products()
    {
    	return $this->belongsTo(Electronicproduct::class, 'product_id');
    }

     public function pos()
    {
    	return $this->belongsTo(Purchaseorder::class, 'poid');
    }

    public function branches()
    {
    	return $this->belongsTo(\App\Branch::class, 'branch_id');
    }
}
