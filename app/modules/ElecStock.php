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

     public function vendors()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }
    public function cvendors()
    {
        return $this->belongsTo(Vendor::class, 'cargo_id');
    }

     public function pos()
    {
    	return $this->belongsTo(Purchaseorder::class, 'po_id');
    }

    public function branches()
    {
    	return $this->belongsTo(\App\Branch::class, 'branch_id');
    }
}
