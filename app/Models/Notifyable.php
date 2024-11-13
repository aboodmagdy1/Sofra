<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifyable extends Model
{

    protected $table = 'notifyables';
    public $timestamps = true;
    protected $fillable = array('notification_id', 'notifyable');
}
