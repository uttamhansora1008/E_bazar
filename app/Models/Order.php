<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable=[
       'order_status',
       'full_address',
       'pincode',
       'city',
       'state',
        'country',
        'phone',
        'user_id',
    ];
}
