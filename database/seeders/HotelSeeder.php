<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    public function run(): void
    {
        $hotels = [
            ['name' => 'Burj Al Arab Grand',  'city' => 'Dubai',     'country' => 'UAE',     'rating' => 5],
            ['name' => 'Atlantis The Palm',    'city' => 'Dubai',     'country' => 'UAE',     'rating' => 5],
            ['name' => 'JW Marriott Marquis',  'city' => 'Dubai',     'country' => 'UAE',     'rating' => 4],
            ['name' => 'Rove Downtown',        'city' => 'Dubai',     'country' => 'UAE',     'rating' => 3],
            ['name' => 'The Savoy',            'city' => 'London',    'country' => 'UK',      'rating' => 5],
            ['name' => 'Premier Inn City',     'city' => 'London',    'country' => 'UK',      'rating' => 3],
            ['name' => 'Four Seasons',         'city' => 'New York',  'country' => 'USA',     'rating' => 5],
            ['name' => 'The Plaza Hotel',      'city' => 'New York',  'country' => 'USA',     'rating' => 5],
            ['name' => 'Sofitel Legend',       'city' => 'Paris',     'country' => 'France',  'rating' => 5],
            ['name' => 'Ibis Paris Centre',    'city' => 'Paris',     'country' => 'France',  'rating' => 3],
        ];

        foreach ($hotels as $hotel) {
            Hotel::create($hotel);
        }
    }
}
