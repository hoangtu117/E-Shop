<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items_oder extends Model
{
    use HasFactory;
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];

    // Relationship with order
    public function order()
    {
        return $this->belongsTo(Oder::class);
    }

    // Relationship with product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
