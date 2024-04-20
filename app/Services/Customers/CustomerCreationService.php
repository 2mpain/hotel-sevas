<?php

namespace App\Services\Customers;

use App\DTO\Customer\CustomerCreationDTO;
use App\DTO\Customer\CustomerDTO;
use App\Infrastructure\Hydrators\CustomerDTOHydrator;
use App\Infrastructure\Repository\Customers\CustomersCRUDRepository;

class CustomerCreationService
{
    public function __construct(
        private CustomersCRUDRepository $customerCRUDRepository,
        private CustomerDTOHydrator $customerDTOHydrator,
    ) {
    }


    public function create(CustomerCreationDTO $customerCreationDTO): CustomerDTO
    {
        try {
            $this->customerCRUDRepository->create($customerCreationDTO);
            $model = $this->customerCRUDRepository->getCustomerModel();
            $dto = $this->customerDTOHydrator->hydrate($model);

            return $dto;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
}
