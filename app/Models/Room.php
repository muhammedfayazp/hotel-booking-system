<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'name',
        'price_per_night',
        'max_occupancy',
        'available_rooms',
    ];

    protected $casts = [
        'price_per_night' => 'decimal:2',
        'max_occupancy'   => 'integer',
        'available_rooms' => 'integer',
    ];

    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }

    public function scopeAvailable($query)
    {
        return $query->where('available_rooms', '>', 0);
    }

    public function scopeForGuests($query, ?int $guests)
    {
        return $guests ? $query->where('max_occupancy', '>=', $guests) : $query;
    }
}
