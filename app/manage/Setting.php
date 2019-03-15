<?php

namespace App\manage;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['company', 'logo', 'address', 'contactone', 'contacttwo', 'fax', 'email', 'website', 'ntn', 'strn', 'version'];
}
