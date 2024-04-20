<?php

namespace App\Infrastructure\Repository;

use App\DTO\AbstractDTO;

interface CRUDRepositoryInterface
{
    public function create(AbstractDTO $DTO): void;

    public function read(AbstractDTO $DTO): void;

    public function update(AbstractDTO $DTO): void;

    public function delete(AbstractDTO $DTO): void;
}