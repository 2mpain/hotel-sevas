<?php

namespace App\Services\Customers;

use App\Infrastructure\Repository\Customers\CustomersRepositoryInterface;
use App\Models\Customer;

class CustomerSettingsGettingService
{
    public function __construct(
        private CustomersRepositoryInterface $customersRepository,
    ) {
    }

    /**
     * @param int $customerId
     * @return Customer
     */
    public function getCustomer(int $customerId): Customer
    {
        return $this->customersRepository->getCustomerById($customerId);
    }

    /**
     * @param string $customerEmail
     * @return Customer
     */
    public function getCustomerByEmail(string $customerEmail): Customer
    {
        return $this->customersRepository->getCustomerByEmail($customerEmail);
    }
}
