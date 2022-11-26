<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderitems extends Model
{
    use HasFactory;
    protected $table = 'order_items';
    protected $fillable = [
        'order_id',
        'order_name',
        'seller_id',
        'user_id',
        'product_id',
        'qty',
        'price',
        'total_price',
    ];
}
