<?php

namespace App\modules;

use Illuminate\Database\Eloquent\Model;

class Cogas extends Model
{
    protected $fillable = [
        'typeid', 'subtype', 'acode', 'aname', 'incom_balance_id', 'acat_id','debitcredit','actype_id','class'
    ];

    protected $dates = [
            'created_at',
            'updated_at',
            'deleted_at'
        ];

    public function subheads()
    {
    	return $this->hasMany(CoaSubHead::class, 'coga_id');
    }

}
