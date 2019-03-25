<?php

namespace App\manage;

use Illuminate\Database\Eloquent\Model;
//use Spatie\Activitylog\Traits\LogsActivity;
	

class Setting extends Model
{
	//use LogsActivity;
    protected $table = 'settings';
    // protected static $logAttributes = ['name', 'text'];
    //protected static $logFillable = true;
	
    protected $fillable = ['company', 'logo', 'address', 'phone', 'mobile', 'fax', 'email', 'website', 'ntn', 'strn', 'version','name', 'text'];
}
