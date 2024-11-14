<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commision extends Model
{

    protected $table = 'commission';
    public $timestamps = true;
    protected $fillable = array('restaurant_id', 'amount', 'details');

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }
}
