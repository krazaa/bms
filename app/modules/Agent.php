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

    protected $dates = [
            'created_at',
            'updated_at',
            'deleted_at'
        ];
}
