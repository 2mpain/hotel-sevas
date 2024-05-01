<?php

namespace App\Observers;

use App\Enums\Customers\CustomersStatusEnum;
use App\Models\Customer;
use Error;
use Illuminate\Support\Facades\Log;

class CustomerObserver
{
    public function creating(Customer $customer): void
    {
        $this->checkCustomerStatus($customer);
    }

    private function checkCustomerStatus(Customer $customer): void
    {
        if ($customer->getStatus() === (string) CustomersStatusEnum::STATUS_LEFT_A_REQUEST) {
            $customer->setArrivalDate(null);
            $customer->setDepartureDate(null);
        }
    }
}
