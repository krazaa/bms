<?php

namespace App\modules;

use Illuminate\Database\Eloquent\Model;

class Cogacctye extends Model
{
     protected $table = 'cogacctypes';

     protected $dates = [
            'created_at',
            'updated_at',
            'deleted_at'
        ];
}
