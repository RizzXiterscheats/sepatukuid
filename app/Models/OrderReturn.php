<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderReturn extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_item_id',
        'reason',
        'description',
        'evidence_photos',
        'bank_name',
        'bank_account_number',
        'bank_account_name',
        'refund_amount',
        'status',
        'admin_note',
        'refund_proof'
    ];

    protected $casts = [
        'evidence_photos' => 'array',
    ];

    /**
     * Get the user that owns the return request.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the order item associated with the return.
     */
    public function item(): BelongsTo
    {
        return $this->belongsTo(OrderItem::class, 'order_item_id');
    }
}
