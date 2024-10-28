<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model 
{

    protected $table = 'notificatinos';
    public $timestamps = true;
    protected $fillable = array('title', 'body');

    public function clients()
    {
        return $this->belongsToMany('App\Models\Client');
    }

}