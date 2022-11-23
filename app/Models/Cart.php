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
        'id',
        'user_id',
        'seller_id',
        'product_id',
        'product_qty',
        'name',
        'price',
    ];

    protected $with = ['products'];
    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
