<?php

namespace App\Http\Controllers;

use App\DTO\Customer\CustomerCreationDTO;
use App\Http\Requests\Customers\CustomerCreateRequest;
use App\Http\Requests\Customers\CustomersSearchRequest;
use App\Response\AbstractResponse;
use App\Services\Customers\CustomerCreationService;
use App\Services\Customers\CustomersGettingService;

class CustomersController extends Controller
{
    public function __construct(private CustomersGettingService $customersGettingService)
    {
    }

    /**
     * @param \App\Http\Requests\Customers\CustomerCreateRequest $request
     * @param \App\Services\Customers\CustomerCreationService $customerCreationService
     * @return AbstractResponse
     */
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

        return new AbstractResponse(["customer" => $customer], 200);
    }

    /**
     * @return AbstractResponse
     */
    public function getCustomers(CustomersSearchRequest $request): AbstractResponse
    {
        $request->validate();

        $customers = $this->customersGettingService
            ->getCustomers($request->toArray());

        return new AbstractResponse($customers, 200);
    }
}
