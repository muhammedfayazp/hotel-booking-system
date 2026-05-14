<?php

namespace Tests\Unit;

use App\Models\Hotel;
use App\Models\Room;
use App\Repositories\Interfaces\HotelRepositoryInterface;
use App\Services\SearchService;
use Mockery;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SearchServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    private function makeHotel(array $rooms = []): Hotel
    {
        $hotel          = new Hotel();
        $hotel->id      = 1;
        $hotel->name    = 'Test Hotel';
        $hotel->city    = 'Dubai';
        $hotel->country = 'UAE';
        $hotel->rating  = 5;

        $roomCollection = collect($rooms)->map(function ($r) {
            $room                  = new Room();
            $room->id              = $r['id'];
            $room->name            = $r['name'];
            $room->price_per_night = $r['price'];
            $room->max_occupancy   = $r['occupancy'];
            $room->available_rooms = $r['available'];
            return $room;
        });

        $hotel->setRelation('rooms', $roomCollection);
        return $hotel;
    }

    #[Test]
    public function it_calculates_total_price_correctly(): void
    {
        $hotel = $this->makeHotel([
            ['id' => 1, 'name' => 'Deluxe', 'price' => 200.00, 'occupancy' => 2, 'available' => 5],
        ]);

        $repo = Mockery::mock(HotelRepositoryInterface::class);
        $repo->shouldReceive('searchAvailable')
             ->once()
             ->andReturn(collect([$hotel]));

        $service = new SearchService($repo);

        $results = $service->search([
            'city'          => 'Dubai',
            'checkin_date'  => '2025-09-01',
            'checkout_date' => '2025-09-04',
            'guests'        => 2,
        ]);

        $this->assertCount(1, $results);
        $this->assertEquals(600.00, $results[0]['rooms'][0]['total_price']);
    }

    #[Test]
    public function it_returns_empty_when_no_hotels_available(): void
    {
        $repo = Mockery::mock(HotelRepositoryInterface::class);
        $repo->shouldReceive('searchAvailable')
             ->once()
             ->andReturn(collect());

        $service = new SearchService($repo);
        $results = $service->search([
            'city'          => 'Unknown City',
            'checkin_date'  => '2025-09-01',
            'checkout_date' => '2025-09-03',
            'guests'        => 2,
        ]);

        $this->assertEmpty($results);
    }

    #[Test]
    public function it_handles_single_night_stay(): void
    {
        $hotel = $this->makeHotel([
            ['id' => 2, 'name' => 'Standard', 'price' => 150.00, 'occupancy' => 2, 'available' => 3],
        ]);

        $repo = Mockery::mock(HotelRepositoryInterface::class);
        $repo->shouldReceive('searchAvailable')->andReturn(collect([$hotel]));

        $service = new SearchService($repo);
        $results = $service->search([
            'city'          => 'Dubai',
            'checkin_date'  => '2025-09-01',
            'checkout_date' => '2025-09-02',
            'guests'        => 1,
        ]);

        $this->assertEquals(150.00, $results[0]['rooms'][0]['total_price']);
        $this->assertEquals(1, $results[0]['nights']);
    }

    #[Test]
    public function it_includes_hotel_meta_in_results(): void
    {
        $hotel = $this->makeHotel([
            ['id' => 3, 'name' => 'Suite', 'price' => 500.00, 'occupancy' => 4, 'available' => 1],
        ]);

        $repo = Mockery::mock(HotelRepositoryInterface::class);
        $repo->shouldReceive('searchAvailable')->andReturn(collect([$hotel]));

        $service = new SearchService($repo);
        $results = $service->search([
            'city'          => 'Dubai',
            'checkin_date'  => '2025-10-01',
            'checkout_date' => '2025-10-05',
            'guests'        => 3,
        ]);

        $result = $results->first();
        $this->assertEquals('Test Hotel', $result['name']);
        $this->assertEquals('Dubai', $result['city']);
        $this->assertEquals('UAE', $result['country']);
        $this->assertEquals(5, $result['rating']);
        $this->assertEquals(4, $result['nights']);
    }
}
