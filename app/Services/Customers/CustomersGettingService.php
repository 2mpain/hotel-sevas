<?php

namespace App\Services\Customers;

use App\Infrastructure\Repository\Customers\CustomersRepositoryInterface;

class CustomersGettingService
{
    public function __construct(
        private CustomersRepositoryInterface $customersRepository
    ) {
    }

    public function getCustomers(array $filters = []): array
    {
        $customers = $this->customersRepository->getCustomers($filters);

        return $customers;
    }

    public function getCustomersCount(): int
    {
        return $this->customersRepository->getCustomersCount();
    }
}

