<?php

namespace App\Models;

use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use FilterTrait;

    protected $table = 'offers';
    public $timestamps = true;
    protected $fillable = array('image', 'name', 'description', 'start_date', 'end_date', 'restaurant_id');

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }
}
