<?php

namespace App\Http\Controllers;

use App\DTO\Customer\CustomerCreationDTO;
use App\Http\Requests\Customers\CustomerCreateRequest;
use App\Http\Requests\Customers\CustomerDeleteRequest;
use App\Http\Requests\Customers\CustomersSearchRequest;
use App\Http\Requests\Customers\CustomerUpdateRequest;
use App\Models\Customer;
use App\Response\AbstractResponse;
use App\Services\Customers\CustomerCreationService;
use App\Services\Customers\CustomerDeletionService;
use App\Services\Customers\CustomerSettingsGettingService;
use App\Services\Customers\CustomerSettingsUpdateService;
use App\Services\Customers\CustomersGettingService;

class CustomersController extends Controller
{
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
     * @param \App\Http\Requests\Customers\CustomersSearchRequest $request
     * @param \App\Services\Customers\CustomersGettingService $customersGettingService
     * @return AbstractResponse
     */
    public function getCustomers(
        CustomersSearchRequest $request,
        CustomersGettingService $customersGettingService
    ): AbstractResponse {
        $request->validate();

        $customers = $customersGettingService->getCustomers($request->toArray());

        return new AbstractResponse($customers, 200);
    }

    /**
     * @param \App\Http\Requests\Customers\CustomersDeleteRequest $request
     * @param \App\Services\Customers\CustomersDeletionService $customersDeletionService
     * @return AbstractResponse
     */
    public function deleteCustomer(
        CustomerDeleteRequest $request,
        CustomerDeletionService $customerDeletionService
    ): AbstractResponse {
        $request->validate();

        $customer = $customerDeletionService->delete($request->getCustomerId());

        return new AbstractResponse(["deletedCustomer" => $customer], 200);
    }

    /**
     * @param \App\Http\Requests\Customers\CustomerUpdateRequest $request
     * @param \App\Services\Customers\CustomerSettingsGettingService $customerSettingsGettingService
     * @param \App\Services\Customers\CustomerSettingsUpdateService $customerSettingUpdateService
     * @return AbstractResponse
     */
    public function updateCustomer(
        CustomerUpdateRequest $request,
        CustomerSettingsGettingService $customerSettingsGettingService,
        CustomerSettingsUpdateService $customerSettingUpdateService,
    ): AbstractResponse {
        $request->validate();

        $customer = $customerSettingsGettingService->getCustomer($request->getId());
        $customerSettingUpdateService->updateCustomer(
            $request,
            $customer
        );

        return new AbstractResponse(['result' => true, 'customer' => $customer]);
    }
}
