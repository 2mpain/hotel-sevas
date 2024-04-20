<?php

namespace App\Http\Controllers;

use App\DTO\Customer\CustomerCreationDTO;
use App\Http\Requests\Customers\CustomerCreateRequest;
use App\Response\AbstractResponse;
use App\Services\Customers\CustomerCreationService;

class CustomersController extends Controller
{
    public function createCustomer(
        CustomerCreateRequest $request,
        CustomerCreationService $customerCreationService
    ): AbstractResponse {
        $request->validate();

        $dto = new CustomerCreationDTO(
            $request->getFirstName(),
            $request->getLastName(),
            $request->getEmail(),
            $request->getPhoneNumber(),
            $request->getStatus(),
            $request->getMiddleName(),
            $request->getArrivalDate(),
            $request->getDepartureDate()
        );

        $customer = $customerCreationService->create($dto);

        return new AbstractResponse($customer, 200);
    }
}
