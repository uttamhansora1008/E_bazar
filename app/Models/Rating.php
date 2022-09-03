<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'user_id',
        'product_id',
        'rating',
        'reviews',
    ];


        public function product()
        {
          return $this->belongsTo(Product::class,'subcategory_id');
        }

}
