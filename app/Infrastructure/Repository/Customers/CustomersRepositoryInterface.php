<?php

namespace App\Infrastructure\Repository\Customers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

interface CustomersRepositoryInterface
{
    public function getCustomers(): array;

    public function getCustomersCount(): int;

    public function getCustomersStatusData(): array;
}