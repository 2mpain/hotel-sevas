<?php

namespace App\DTO;

abstract class AbstractDTO implements \JsonSerializable
{
    abstract public function toArray(): array;

    #[\Override] public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}