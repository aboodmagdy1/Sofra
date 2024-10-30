<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commision extends Model
{

    protected $table = 'commission';
    public $timestamps = true;
    protected $fillable = array('resturant_id', 'amount', 'details');

    public function resturant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }
}
