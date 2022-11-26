<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivered extends Model
{
    use HasFactory;
    protected $table = 'delivered';
    protected $fillable = [
        'seller_id',
        'order_id',
        'order_name',
        'order_price',
        'order_qty',
        'order_total',
        'firstname',
        'middlename',
        'lastname',
        'contactNo',
        'shippingadress',
        'modeofpayment',
    ];
}
