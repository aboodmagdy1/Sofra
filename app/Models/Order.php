<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    use FilterTrait;
    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = array('cost', 'commission_price', 'delivery_price', 'total_price', 'payment_method_id', 'note', 'address', 'restaurant_id', 'client_id', 'status', 'net');

    public function meals()
    {
        return $this->belongsToMany('App\Models\Meal')->withPivot('quantity', 'price', 'note');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

    public function paymentMethod()
    {
        return $this->belongsTo('App\Models\PaymentMethod');
    }
}
