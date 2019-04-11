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

     
}
