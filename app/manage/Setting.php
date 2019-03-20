<?php

namespace App\manage;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Setting extends Model
{
	use LogsActivity;

    protected $fillable = ['name', 'text'];
    
    protected static $logAttributes = ['name', 'text'];
	
    protected $fillable = ['company', 'logo', 'address', 'contactone', 'contacttwo', 'fax', 'email', 'website', 'ntn', 'strn', 'version'];
}
