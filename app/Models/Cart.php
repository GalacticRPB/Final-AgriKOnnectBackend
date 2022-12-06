<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';
    protected $fillable = [
        'product_id',
        'user_id',
        'seller_id',
        'product_qty',
        'name',
        'price',
        'image',
    ];
}
