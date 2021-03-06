<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected static $logFillable = ['name','text'];

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected static $logFillable = true;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function branches()
    {
        return $this->belongsToMany('App\Branch', 'branch_user');
        //return $this->belongsToMany('App\Branch', 'branch_user', 'branch_id', 'user_id');
    }
}
