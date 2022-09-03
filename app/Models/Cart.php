<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable=[
        'product_id',
        'user_id',
        'quantity',
    ];
protected $hidden=[
'updated_at',
'created_at',
];
protected $casts = [

    'id' => 'array',
];
public function image()
{
    return $this->hasOne(Image::class,'product_id');
}
}
