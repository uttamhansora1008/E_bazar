<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=[
       'id',
       'name',
       'price',
       'discount',
       'description',
       'stock',
       'subcategory_id',
    ];
    protected $hidden=[
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function productimage()
    {
        return $this->hasMany(Image::class,'product_id');
    }
    public function image()
    {
        return $this->hasOne(Image::class,'product_id');
    }

        public function ratings()
        {
          return $this->hasMany(Rating::class);
        }

}
