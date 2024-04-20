<?php

namespace App\Infrastructure\Hydrators;

use App\DTO\AbstractDTO;

abstract class AbstractHydrator
{
    abstract public function hydrate(mixed $data): AbstractDTO;
}