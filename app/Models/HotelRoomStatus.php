<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelRoomStatus extends Model
{
    use HasFactory;

    public $table = 'hotel_rooms_statuses';

    protected $fillable = [
        'name'
    ];
}
