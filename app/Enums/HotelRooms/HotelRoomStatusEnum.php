<?php

namespace App\Enums\HotelRooms;

use Spatie\Enum\Enum;

/**
 * @method static self booked()
 * @method static self on_cleaning()
 * @method static self occupied()
 * @method static self unoccupied()
 * @method static self for_repair()
 */
class HotelRoomStatusEnum extends Enum
{
    public const STATUS_BOOKED         = 1;
    public const STATUS_ON_CLEANING    = 2;
    public const STATUS_OCCUPIED       = 3;
    public const STATUS_UNOCCUPIED     = 4;
    public const STATUS_FOR_REPAIR     = 5;

    protected static function labels(): array
    {
        return [
            'booked'          => 'На брони',
            'on_cleaning'     => 'Уборка',
            'occupied'        => 'В аренде',
            'unoccupied'      => 'Свободен',
            'for_repair'      => 'Подлежит ремонту'
        ];
    }

    protected static function values(): array
    {
        return [
            'booked'        => self::STATUS_BOOKED,
            'on_cleaning'   => self::STATUS_ON_CLEANING,
            'occupied'      => self::STATUS_OCCUPIED,
            'unoccupied'    => self::STATUS_UNOCCUPIED,
            'for_repair'    => self::STATUS_FOR_REPAIR
        ];
    }
}
