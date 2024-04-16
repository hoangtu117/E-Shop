<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oder extends Model
{
    use HasFactory;
    protected $fillable = ['user_id'];

    // Relationship with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with order items
    public function orderItem()
    {
        return $this->hasMany(Items_oder::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }
}
