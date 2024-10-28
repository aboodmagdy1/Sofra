<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commision extends Model 
{

    protected $table = 'commission';
    public $timestamps = true;
    protected $fillable = array('resturant_id', 'payed', 'details');

    public function resturant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

}