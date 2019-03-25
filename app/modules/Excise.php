<?php

namespace App\modules;

use Illuminate\Database\Eloquent\Model;

class Excise extends Model
{
     protected $fillable = [
        'office', 'model', 'agent_id', 'cost', 'selling'
    ];
}
