<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;


class Restaurant extends Authenticatable
{
    use HasApiTokens;
    protected $table = 'restaurants';
    public $timestamps = true;
    protected $fillable = array('status', 'name', 'phone', 'district_id', 'min_order_price', 'delivery_price', 'avg_rate', 'contact_num', 'watts_num', 'image', 'password', 'reset_code', 'email');
    protected $hidden = ['password', 'reset_code'];
    public function district()
    {
        return $this->belongsTo('App\Models\District');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function meals()
    {
        return $this->hasMany('App\Models\Meal');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function commissions()
    {
        return $this->hasMany('App\Models\Commision');
    }

    public function offers()
    {
        return $this->hasMany('App\Models\Offer');
    }

    public function notifications()
    {
        return $this->morphToMany('App\Models\Notification', 'notifiable');
    }



    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
