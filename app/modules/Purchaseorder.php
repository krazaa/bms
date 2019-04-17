<?php

namespace App\modules;

use Illuminate\Database\Eloquent\Model;

class Purchaseorder extends Model
{
    protected $fillable = ['product_id','qty','branch_id','vendor_id'];

    protected $casts = [
      'product_id' => 'array',
      'branch_id ' => 'array',
      'qty' => 'array',
	];

    public function setPoDateAttribute($value)
	{
    $this->attributes['podate'] = date("Y-m-d H:i:s");
	}

  public function scopeSR($query)
    {
        return $query->where('stockReceive', false);
    }

     public function products()
    {
        return $this->belongsTo('App\modules\Electronicproduct', 'product_id');
        
    }

      public function vendors()
    {
        return $this->belongsTo('App\modules\Vendor', 'vendor_id');
        
    }

      public function elecstocks()
    {
        return $this->belongsTo('App\modules\ElecStock', 'po_id');
        
    }
}
