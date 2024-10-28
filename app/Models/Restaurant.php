<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model 
{

    protected $table = 'restaurants';
    public $timestamps = true;
    protected $fillable = array('status', 'name', 'district_id', 'min_order_price', 'delivery_price', 'avg_rate', 'mobile', 'watts_number', 'image');

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

}