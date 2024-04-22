<?php

namespace App\Infrastructure\Mutators\Customers;

use App\Models\Customer;

interface CustomerSettingsMutatorInterface
{
    public function updateCustomer(array $customerDate, Customer $customer): void;
}
