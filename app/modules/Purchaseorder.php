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
}
