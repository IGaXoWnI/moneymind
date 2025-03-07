<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_name',
        'description',
        'estimated_cost',
        'monthly_contribution',
        'status',
        'saved_amount',
        'purchased_at'
    ];

    protected $casts = [
        'purchased_at' => 'datetime',
        'estimated_cost' => 'decimal:2',
        'monthly_contribution' => 'decimal:2',
        'saved_amount' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 