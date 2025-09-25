<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'user_id', 
        'product_id',
        'product_name',
        'product_price',
        'quantity',
        'product_image'
    ];

    protected $casts = [
        'product_price' => 'decimal:2'
    ];

    // Relations
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Calcul du sous-total
    public function getSubtotalAttribute()
    {
        return $this->product_price * $this->quantity;
    }
}
