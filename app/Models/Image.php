<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable =[
         'id',
         'image',
         'product_id',
    ];
    protected $hidden=[
            'created_at',
            'updated_at',
            'deleted_at',
    ];
    public function images()
    {
        return $this->belongsTo(Product::class,'subcategory_id');
    }
    public function wishlist()
    {
        return $this->hasOne(Wishlist::class,'product_id');
    }
    public function subcategory()
    {
        return $this->hasOne(SubCategory::class,'category_id');
    }
    public function getImageAttribute($val)
    {
        return asset('storage/image/'.$val);
    }
    public function cart()
    {
        return $this->hasOne(Cart::class,'product_id');
    }
}
