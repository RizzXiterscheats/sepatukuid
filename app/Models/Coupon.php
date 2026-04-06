<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'type', 'value', 'min_purchase', 'valid_until', 'is_active'];

    protected $casts = [
        'valid_until' => 'datetime',
        'is_active' => 'boolean',
    ];
}
