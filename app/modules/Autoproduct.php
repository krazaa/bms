<?php

namespace App\modules;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Autoproduct extends Model
{   
    use SoftDeletes;
	protected $guarded = ['id'];
	
    public function vendorinfo()
    {
    	return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    public function users()
    {
    	return $this->belongsTo(User::class);
    }
    
    protected $dates = [
            'created_at',
            'updated_at',
            'deleted_at'
        ];
}
