<?php

namespace App\Models;

use Database\Factories\CustomerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'email',
        'phoneNumber',
        'status',
        'feedbacks_count',
        'room_number'
    ];

    protected static function newFactory()
    {
        return new CustomerFactory();
    }

    public function room()
    {
        return $this->belongsTo(HotelRoom::class, 'room_number');
    }
}
