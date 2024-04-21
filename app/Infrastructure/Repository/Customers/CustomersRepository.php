<?php

namespace App\Infrastructure\Repository\Customers;

use App\Models\Customer;
use Carbon\Carbon;

class CustomersRepository implements CustomersRepositoryInterface
{

    /**
     * @return array
     */
    #[\Override] public function getCustomers(array $filters = []): array
    {
        $query = Customer::query();

        if (isset($filters['name'])) {
            $name = $filters['name'];
            if (is_numeric($name)) {
                $query->where(['id' => $name]);
            } else {
                $query->where(function ($q) use ($name) {
                    $q->where('first_name', 'like', "%{$name}%")
                        ->orWhere('middle_name', 'like', "%{$name}%")
                        ->orWhere('last_name', 'like', "%{$name}%");
                });
            }
        }

        if (isset($filters['new']) && $filters['new'] === true) {
            $query->where(
                'created_at',
                '>=',
                Carbon::now()->subDay()
            );
        }

        if (isset($filters['arrivalDate']) && isset($filters['departureDate'])) {
            $arrivalDate = Carbon::parse($filters['arrivalDate']);
            $departureDate = Carbon::parse($filters['departureDate']);
            $query->whereBetween(
                'arrival_date',
                [
                    $arrivalDate,
                    $departureDate,
                ]
            )
                ->whereBetween('departure_date', [
                    $arrivalDate,
                    $departureDate,
                ]);
        } else if (isset($filters['arrivalDate'])) {
            $arrivalDate = Carbon::parse($filters['arrivalDate']);
            $query->whereDate('arrival_date', $arrivalDate);
        } else if (isset($filters['departureDate'])) {
            $departureDate = Carbon::parse($filters['departureDate']);
            $query->whereDate('departure_date', $departureDate);
        }

        if (isset($filters['phoneNumber'])) {
            $query->where(
                'phoneNumber',
                'like',
                "%{$filters['phoneNumber']}%"
            );
        }

        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        $customers = $query->get()->toArray();

        return [
            'data' => [
                'totalCustomers' => $this->getCustomersCount(),
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
