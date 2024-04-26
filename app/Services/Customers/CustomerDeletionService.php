<?php

namespace App\Services\Customers;

use App\DTO\Customer\CustomerCreationDTO;
use App\DTO\Customer\CustomerDTO;
use App\Infrastructure\Hydrators\CustomerDTOHydrator;
use App\Infrastructure\Repository\Customers\CustomersCRUDRepository;
use App\Infrastructure\Repository\Customers\CustomersRepository;

class CustomerDeletionService
{
    public function __construct(
        private CustomersCRUDRepository $customerCRUDRepository,
        private CustomerDTOHydrator $customerDTOHydrator,
        private CustomersRepository $customersRepository
    ) {
    }


    public function delete(int $customerId): CustomerDTO
    {
        try {
            $customer = $this->customersRepository->getCustomerById($customerId);

            $dto = new CustomerDTO(
                $customer->getFirstName(),
                $customer->getLastName(),
                $customer->getEmail(),
                $customer->getPhoneNumber(),
                $customer->getMiddleName(),
                $customer->getArrivalDate(),
                $customer->getDepartureDate(),
                $customer->getStatus(),
                $customer->getId()
            );

            $this->customerCRUDRepository->delete($dto);

            $model = $this->customerDTOHydrator->hydrate($customer);

            return $model;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
}
