<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'status',
        'category_id',
    ];
    protected $hidden=[
         'created_at',
         'updated_at',
         'deleted_at',
    ];
    public function image()
    {
        return $this->hasOne(Image::class,'product_id');
    }
    public function productimage()
    {
        return $this->hasMany(Image::class,'product_id');
    }
}
