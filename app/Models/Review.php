<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table = 'reviews';
    protected $fillable = [
        'seller_id',
        'firstname',
        'middlename',
        'lastname',
        'order_name',
        'order_qty',
        'order_total',
        'review',
    ];
}
