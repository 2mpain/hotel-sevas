<?php

namespace App\Services\Users;

use App\Infrastructure\Repository\Users\UsersRepositoryInterface;

class UserSettingsGettingService
{
    public function __construct(
        private UsersRepositoryInterface $usersRepository
    ) {
    }

    /**
     * @return array
     */
    public function getUsers(): array
    {
        $users[] = $this->usersRepository->getList();

        return $users;
    }

    /**
     * @return int
     */
    public function getUsersCount(): int
    {
        return $this->usersRepository->getCount();
    }
}

