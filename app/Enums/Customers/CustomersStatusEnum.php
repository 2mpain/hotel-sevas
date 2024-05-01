<?php

namespace App\Enums\Customers;

use Spatie\Enum\Enum;

/**
 * @method static self left_a_request()
 * @method static self active()
 * @method static self inactive()
 */
class CustomersStatusEnum extends Enum
{
    public const STATUS_LEFT_A_REQUEST = 1;
    public const STATUS_ACTIVE         = 2;
    public const STATUS_INACTIVE       = 3;

    protected static function labels(): array
    {
        return [
            'left_a_request'  => 'Оставил заявку',
            'active'          => 'Проживает',
            'inactive'        => 'Выселился',
        ];
    }

    protected static function values(): array
    {
        return [
            'left_a_request'  => self::STATUS_LEFT_A_REQUEST,
            'active'          => self::STATUS_ACTIVE,
            'inactive'        => self::STATUS_INACTIVE,
        ];
    }
}
