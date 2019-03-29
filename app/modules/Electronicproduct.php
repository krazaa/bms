<?php

namespace App\modules;

use Illuminate\Database\Eloquent\Model;

class Electronicproduct extends Model
{
    protected $guarded = ['id'];
    protected $dates = [
            'created_at',
            'updated_at',
            'deleted_at'
        ];
}
