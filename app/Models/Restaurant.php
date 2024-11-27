<?php

namespace App\Models;

use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;


class Restaurant extends Authenticatable
{
    use HasApiTokens, Notifiable, FilterTrait;
    protected $table = 'restaurants';
    public $timestamps = true;
    protected $fillable = array('is_active', 'status', 'name', 'phone', 'district_id', 'min_order_price', 'delivery_price', 'avg_rate', 'contact_num', 'watts_num', 'image', 'password', 'reset_code', 'email');
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
        return $this->morphToMany(Notification::class, 'notifyable');
    }



    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }


    public function routeNotificationForFcm()
    {
        return $this->getFcmToken();
    }

    public function getFcmToken()
    {
        return  \Laravel\Sanctum\PersonalAccessToken::where('name', 'mobile')
            ->where('tokenable_type', '=', Restaurant::class)
            ->where('tokenable_id', '=', $this->id)
            ->pluck('token')
            ->first();
    }
}
