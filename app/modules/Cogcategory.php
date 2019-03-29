<?php

namespace App\modules;

use Illuminate\Database\Eloquent\Model;

class Cogcategory extends Model
{
    protected $dates = [
            'created_at',
            'updated_at',
            'deleted_at'
        ];
}
