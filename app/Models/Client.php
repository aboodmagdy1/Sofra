<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class Client extends  Authenticatable
{

    use HasApiTokens;

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = ['name', 'email', 'district_id', 'password', 'phone', 'reset_code'];
    protected $hidden = ['password', 'reset_code'];

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function orders()
    {
        return $this->hasMany('Order');
    }

    public function notifications()
    {
        return $this->belongsToMany('App\Models\Notification');
    }

    public function district()
    {
        return $this->belongsTo('App\Models\District');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
