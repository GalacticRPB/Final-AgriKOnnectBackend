<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ongoing extends Model
{
    use HasFactory;
    protected $table = 'ongoings';
    protected $fillable = [
   
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
