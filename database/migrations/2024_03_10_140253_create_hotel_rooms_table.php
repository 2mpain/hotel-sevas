<?php

use App\Enums\HotelRooms\HotelRoomStatusEnum;
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
        Schema::create('hotel_rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_type_id')->constrained('hotel_room_types');
            $table->unsignedInteger('floor');
            $table->unsignedInteger('number');
            $table->unsignedInteger('status_id');
            $table->foreign('status_id')->references('id')->on('hotel_rooms_statuses');
            $table->integer('occupants')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_rooms');
    }
};
