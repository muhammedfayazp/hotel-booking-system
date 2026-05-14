<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        $rooms = [
            // Burj Al Arab (hotel_id: 1)
            ['hotel_id' => 1, 'name' => 'Deluxe Ocean View',  'price_per_night' => 850,  'max_occupancy' => 2, 'available_rooms' => 5],
            ['hotel_id' => 1, 'name' => 'Sky Suite',           'price_per_night' => 2500, 'max_occupancy' => 4, 'available_rooms' => 2],

            // Atlantis (hotel_id: 2)
            ['hotel_id' => 2, 'name' => 'Standard Room',       'price_per_night' => 350,  'max_occupancy' => 2, 'available_rooms' => 10],
            ['hotel_id' => 2, 'name' => 'Family Suite',        'price_per_night' => 700,  'max_occupancy' => 6, 'available_rooms' => 4],
            ['hotel_id' => 2, 'name' => 'Executive Suite',     'price_per_night' => 1200, 'max_occupancy' => 2, 'available_rooms' => 3],

            // JW Marriott (hotel_id: 3)
            ['hotel_id' => 3, 'name' => 'Deluxe Room',         'price_per_night' => 280,  'max_occupancy' => 2, 'available_rooms' => 15],
            ['hotel_id' => 3, 'name' => 'Junior Suite',        'price_per_night' => 450,  'max_occupancy' => 3, 'available_rooms' => 6],

            // Rove Downtown (hotel_id: 4)
            ['hotel_id' => 4, 'name' => 'Superior Room',       'price_per_night' => 120,  'max_occupancy' => 2, 'available_rooms' => 20],
            ['hotel_id' => 4, 'name' => 'Twin Room',           'price_per_night' => 130,  'max_occupancy' => 2, 'available_rooms' => 12],

            // The Savoy (hotel_id: 5)
            ['hotel_id' => 5, 'name' => 'Classic Room',        'price_per_night' => 500,  'max_occupancy' => 2, 'available_rooms' => 8],
            ['hotel_id' => 5, 'name' => 'River Suite',         'price_per_night' => 1500, 'max_occupancy' => 4, 'available_rooms' => 3],

            // Premier Inn (hotel_id: 6)
            ['hotel_id' => 6, 'name' => 'Standard Room',       'price_per_night' => 100,  'max_occupancy' => 2, 'available_rooms' => 25],

            // Four Seasons NY (hotel_id: 7)
            ['hotel_id' => 7, 'name' => 'Superior Room',       'price_per_night' => 700,  'max_occupancy' => 2, 'available_rooms' => 10],
            ['hotel_id' => 7, 'name' => 'Deluxe Suite',        'price_per_night' => 1800, 'max_occupancy' => 4, 'available_rooms' => 4],

            // The Plaza (hotel_id: 8)
            ['hotel_id' => 8, 'name' => 'Classic Room',        'price_per_night' => 600,  'max_occupancy' => 2, 'available_rooms' => 7],

            // Sofitel Paris (hotel_id: 9)
            ['hotel_id' => 9, 'name' => 'Luxury Room',         'price_per_night' => 450,  'max_occupancy' => 2, 'available_rooms' => 12],
            ['hotel_id' => 9, 'name' => 'Opera Suite',         'price_per_night' => 1100, 'max_occupancy' => 3, 'available_rooms' => 5],

            // Ibis Paris (hotel_id: 10)
            ['hotel_id' => 10, 'name' => 'Standard Room',      'price_per_night' => 90,   'max_occupancy' => 2, 'available_rooms' => 30],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}
