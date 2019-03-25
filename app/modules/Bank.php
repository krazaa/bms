<?php

namespace App\modules;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = [
        'bank', 'branchcode', 'iban', 'account', 'phone', 'mobile','address','city'
    ];
}
