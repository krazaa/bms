<?php

namespace App\modules;

use Illuminate\Database\Eloquent\Model;

class Autoproduct extends Model
{
	protected $guarded = ['id'];
	
    public function vendorinfo()
    {
    	return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    public function users()
    {
    	return $this->belongsTo(User::class);
    }
}
