<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->decimal('price_per_night', 10, 2);
            $table->unsignedSmallInteger('max_occupancy');
            $table->unsignedSmallInteger('available_rooms')->default(0);
            $table->timestamps();

            $table->index(['hotel_id', 'available_rooms']);
            $table->index('max_occupancy');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
