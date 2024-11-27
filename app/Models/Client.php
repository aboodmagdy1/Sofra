<?php

namespace App\Models;

use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class Client extends  Authenticatable
{

    use HasApiTokens, Notifiable, FilterTrait;

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = ['name', 'email', 'district_id', 'password', 'phone', 'reset_code', 'image', 'is_active'];
    protected $hidden = ['password', 'reset_code'];

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function notifications()
    {
        return $this->morphToMany(Notification::class, 'notifyable');
    }

    public function district()
    {
        return $this->belongsTo('App\Models\District');
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
            ->where('tokenable_type', '=', Client::class)
            ->where('tokenable_id', '=', $this->id)
            ->pluck('token')
            ->first();
    }
}
