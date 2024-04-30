<?php

namespace App\Infrastructure\Repository\Users;

use Illuminate\Database\Eloquent\Collection;

interface UsersRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getList(): Collection;

    /**
     * @return int
     */
    public function getCount(): int;
}