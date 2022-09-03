<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'status',
    ];
    protected $hidden=[
'created_at',
'updated_at'
    ];
    public function subcategory()
    {
        return $this->hasOne(SubCategory::class,'category_id');
    }
    public function image()
    {
        return $this->hasOne(Image::class,'product_id');
    }
}
