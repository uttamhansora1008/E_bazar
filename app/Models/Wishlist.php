<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'user_id',
        'product_id',
    ];
    public function productimage()
    {
        return $this->hasMany(Image::class);
    }
    protected $hidden=[
          'created_at',
          'updated_at'
    ];
}

