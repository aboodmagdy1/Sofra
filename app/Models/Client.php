<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model 
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'distric_id', 'password');

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

}