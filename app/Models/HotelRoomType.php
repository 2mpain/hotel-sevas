<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class HotelRoomType extends Model
{
    protected $fillable = [
        "type",
        "description",
        "price",
        "image"
    ];

    public function rooms()
    {
        return $this->hasMany(HotelRoom::class, 'room_type_id');
    }
}
