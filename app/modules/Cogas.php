<?php

namespace App\modules;

use Illuminate\Database\Eloquent\Model;

class Cogas extends Model
{
    
    public function subheads()
    {
    	return $this->hasMany(CoaSubHead::class, 'coga_id');
    }
}
