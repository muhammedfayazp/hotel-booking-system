<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'city',
        'country',
        'rating',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    public function scopeByCity($query, ?string $city)
    {
        return $city ? $query->where('city', 'like', "%{$city}%") : $query;
    }

    public function scopeByRating($query, ?int $rating)
    {
        return $rating ? $query->where('rating', $rating) : $query;
    }
}
