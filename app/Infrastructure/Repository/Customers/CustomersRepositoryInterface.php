<?php

namespace App\Infrastructure\Repository\Customers;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

interface CustomersRepositoryInterface
{
    public function getCustomers(array $filters = []): array;

    public function getCustomersCount(): int;

    public function getCustomersStatusData(): array;

    public function getCustomerById(int $id): Customer;

    public function getCustomerByEmail(string $email): Customer;
}