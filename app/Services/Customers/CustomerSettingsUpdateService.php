<?php

namespace App\Services\Customers;

use App\Http\Requests\Customers\CustomerUpdateRequest;
use App\Infrastructure\Mutators\Customers\CustomerSettingsMutatorInterface;
use App\Models\Customer;

class CustomerSettingsUpdateService
{

    public function __construct(
        private CustomerSettingsMutatorInterface $customerSettingsMutator,
    ) {
    }
    /**
     * @param CustomerUpdateRequest $request
     * @param Customer $user
     *
     * @return void
     */
    public function updateCustomer(CustomerUpdateRequest $request, Customer $customer): void
    {
        $customerData = [
            'firstName' => $request->getFirstName(),
            'middleName' => $request->getMiddleName(),
            'lastName' => $request->getLastName(),
            'email' => $request->getEmail(),
            'phoneNumber' => $request->getPhoneNumber(),
            'arrivalDate' => $request->getArrivalDate(),
            'departureDate' => $request->getDepartureDate(),
            'status' => $request->getStatus(),
            'roomNumber' => $request->getRoomNumber()
        ];

        $this->customerSettingsMutator->updateCustomer(
            array_filter($customerData),
            $customer
        );
    }
}
