<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'total',
        'status',
        'payment_method',
        'payment_status',
        'shipping_address',
        'shipping_method',
        'payment_proof',
        'notes',
        'cancel_reason',
        'voucher_code',
        'discount_amount'
    ];

    protected $casts = [
        'total' => 'decimal:2',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke order items
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function tracks()
    {
        return $this->hasMany(OrderTrack::class);
    }

    // Generate order number
    public static function generateOrderNumber()
    {
        return 'ORD-' . date('Ymd') . '-' . strtoupper(uniqid());
    }

    // Boot method untuk auto generate order number
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (empty($order->order_number)) {
                $order->order_number = static::generateOrderNumber();
            }
        });
    }
}