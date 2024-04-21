<?php

namespace App\Infrastructure\Repository\Customers;

use App\Models\Customer;

class CustomersRepository implements CustomersRepositoryInterface
{

    /**
     * @return array
     */
    #[\Override] public function getCustomers(): array
    {
        $query = Customer::query();
        $customers = $query->get()->toArray();

        return [
            'data' => [
                'totalCustomers' => $this->getCustomersCount($customers),
                'customersStatuses' => $this->getCustomersStatusData(),
            ],
            'customers' => $customers,
        ];
    }

    /**
     * @return int
     */
    #[\Override] public function getCustomersCount(): int
    {
        return Customer::count();
    }

    /**
     * @return array
     */
    #[\Override] public function getCustomersStatusData(): array
    {
        $activeCustomersCount = Customer::where('status', 'active')->count();
        $inactiveCustomersCount = Customer::where('status', 'inactive')->count();
        $leftARequestCustomersCount = Customer::where('status', 'left_a_request')->count();

        return [
            'activeCustomersCount' => $activeCustomersCount,
            'inactiveCustomersCount' => $inactiveCustomersCount,
            'leftARequestCustomersCount' => $leftARequestCustomersCount,
        ];
    }
}
