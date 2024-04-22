<?php

namespace App\Infrastructure\Mutators\Customers;

use App\Models\Customer;
use App\Services\Customers\CustomerSettingsGettingService;

class CustomerSettingsMutator implements CustomerSettingsMutatorInterface
{

    public function __construct(
        private CustomerSettingsGettingService $customerSettingsGettingService,
    ) {
    }

    #[\Override] public function updateCustomer(array $customerData, Customer $customer): void
    {
        if (isset($customerData['firstName'])) {
            $customer->setFirstName($customerData['firstName']);
        }

        if (isset($customerData['middleName'])) {
            $customer->setMiddleName($customerData['middleName']);
        }

        if (isset($customerData['lastName'])) {
            $customer->setLastName($customerData['lastName']);
        }

        if (isset($customerData['email'])) {
            $customer->setEmail($customerData['email']);
        }

        if (isset($customerData['phoneNumber'])) {
            $customer->setPhoneNumber($customerData['phoneNumber']);
        }

        if (isset($customerData['arrivalDate'])) {
            $customer->setArrivalDate($customerData['arrivalDate']);
        }

        if (isset($customerData['departureDate'])) {
            $customer->setDepartureDate($customerData['departureDate']);
        }

        if (isset($customerData['status'])) {
            $customer->setStatus($customerData['status']);
        }

        if (isset($customerData['roomNumber'])) {
            $customer->setRoomNumber($customerData['roomNumber']);
        }

        $customer->saveOrFail();
    }
}
