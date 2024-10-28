<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model 
{

    protected $table = 'cites';
    public $timestamps = true;
    protected $fillable = array('name');

    public function districts()
    {
        return $this->hasMany('App\Models\District');
    }

}