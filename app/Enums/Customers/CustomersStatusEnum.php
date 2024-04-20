<?php

namespace App\Enums\Customers;

use Spatie\Enum\Enum;

/**
 * @method static self inactive()
 * @method static self left_a_request()
 * @method static self active()
 */
class CustomersStatusEnum extends Enum
{
    public const STATUS_LEFT_A_REQUEST = 1;
    public const STATUS_ACTIVE         = 2;
    public const STATUS_INACTIVE       = 3;

    protected static function labels(): array
    {
        return [
            'inactive'        => 'Inactive',
            'left_a_request'  => 'Left a request',
            'active'          => 'Active',
        ];
    }

    protected static function values(): array
    {
        return [
            'inactive'        => self::STATUS_INACTIVE,
            'left_a_request'  => self::STATUS_LEFT_A_REQUEST,
            'active'          => self::STATUS_ACTIVE,
        ];
    }
}
