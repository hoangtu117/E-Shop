<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=[
        'category_id',
        'name',
        'price',
        'img_thumb',
        'so_luong',
        'desc',
        'status'
    ];

    // quan hệ 1-1
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
