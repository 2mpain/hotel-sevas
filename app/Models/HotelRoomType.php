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
}
