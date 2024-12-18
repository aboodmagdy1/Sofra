<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('title', 'body', 'is_read', 'notifyable');

    public function clients()
    {
        return $this->morphedByMany('App\Models\Client', 'notifyable');
    }

    public function restaurants()
    {
        return $this->morphedByMany('App\Models\Restaurant', 'notifyable');
    }
}
