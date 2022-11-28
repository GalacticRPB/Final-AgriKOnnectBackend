<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'shippingadress',
        'paymentId',
        'modeofpayment',
    ];

    public function order_items()
    {
        return $this->hasMany(OrderItems::class, 'order_id', 'id');
    }
}
