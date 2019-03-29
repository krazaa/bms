<?php

namespace App\modules;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{

     protected $fillable = ['type', 'brand', 'isActive'];

     public function scopeActive($query)
    {
        return $query->where('isActive', true);
    }

    public function scopeAutos($query)
    {
        return $query->where('type', 1);
    }

    public function scopeElectronic($query)
    {
        return $query->where('type', 2);
    }

    protected $dates = [
            'created_at',
            'updated_at',
            'deleted_at'
        ];
}
