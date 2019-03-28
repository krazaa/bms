<?php

namespace App\modules;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    protected $fillable = [
        'person', 'company', 'cnic', 'mobile', 'tel', 'email','baddress','haddress','city'
    ];

    public function scopeActive($query)
    {
        return $query->where('isActive', true);
    }


}
