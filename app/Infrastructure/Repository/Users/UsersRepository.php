<?php

namespace App\Infrastructure\Repository\Users;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UsersRepository implements UsersRepositoryInterface
{

    #[\Override] public function getList(): Collection
    {
        return User::query()->get();
    }

    #[\Override] public function getCount(): int
    {
        return User::query()->count();
    }
}
