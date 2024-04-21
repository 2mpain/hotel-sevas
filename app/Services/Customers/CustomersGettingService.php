<?php

namespace App\Services\Customers;

use App\Infrastructure\Repository\Customers\CustomersRepositoryInterface;

class CustomersGettingService
{
    public function __construct(
        private CustomersRepositoryInterface $customersRepository
    ) {
    }

    public function getCustomers(): array
    {
        $customers = $this->customersRepository->getCustomers();

        return $customers;
    }
}

