<?php

namespace App\Models;

use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{

    use FilterTrait;
    protected $table = 'contacts';
    public $timestamps = true;
    protected $fillable = array('full_name', 'email', 'phone', 'message', 'type');
}
