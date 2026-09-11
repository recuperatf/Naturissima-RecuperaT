<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use Billable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','user_rol_id','license'
    ];
    protected $dates = [
        'deleted_at'
    ];

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

    public function rol(){
        return $this->belongsTo("App\UserRol","user_rol_id");
    }

    public function getAdminAttribute(){
        return ($this->rol->id == 1);
    }

    public function image_resources(){
        return $this->hasMany('App\ImageResource', 'user_id','id');
    }

    public function permissions() {
        return $this->belongsToMany('App\Permission');
    }

    public function getReadablePermissions() {
        return array_map(function ($permission) {
            return $permission['name'];
        }, $this->permissions->toArray());
    }
}
