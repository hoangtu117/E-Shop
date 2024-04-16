<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name','status','create_at'];

    //1-n
    public function product(){
        return $this->hasMany(Product::class,'category_id','id');
    }
}
