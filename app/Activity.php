<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activity_log';
    
    protected $casts = [
        'properties' => 'collection',
    ];
}
