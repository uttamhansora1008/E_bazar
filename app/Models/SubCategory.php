<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    protected $table = 'subcategory';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'status	',
        
    ];
}
