<?php

namespace App\manage;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
	

class Setting extends Model
{
	use LogsActivity;
    
    // protected static $logAttributes = ['name', 'text'];
    protected static $logFillable = true;
	
    protected $fillable = ['company', 'logo', 'address', 'contactone', 'contacttwo', 'fax', 'email', 'website', 'ntn', 'strn', 'version','name', 'text'];
}
