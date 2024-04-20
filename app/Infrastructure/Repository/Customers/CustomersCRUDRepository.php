<?php

namespace App\Infrastructure\Repository\Customers;

use App\DTO\AbstractDTO;
use App\Infrastructure\Repository\CRUDRepositoryInterface;
use App\Models\Customer;

class CustomersCRUDRepository implements CRUDRepositoryInterface
{
    private Customer $model;

    /**
     * @return Customer
     */
    public function getCustomerModel(): Customer
    {
        return $this->model;
    }


    /**
     * @param \App\Services\Customers\CustomerCreationDTO $DTO
     * @return void
     */
    #[\Override] public function create(AbstractDTO $DTO): void
    {
        $customerModel = new Customer([
            'first_name'     => $DTO->getFirstName(),
            'last_name'      => $DTO->getLastName(),
            'email'          => $DTO->getEmail(),
            'phoneNumber'    => $DTO->getPhoneNumber(),
            'middle_name'    => $DTO->getMiddleName(),
            'arrival_date'   => $DTO->getArrivalDate(),
            'departure_date' => $DTO->getDepartureDate(),
            'status'         => $DTO->getStatus(),
        ]);

        $customerModel->saveOrFail();

        $this->model = $customerModel;
    }

    #[\Override] public function read(AbstractDTO $DTO): void
    {
        // TODO: Implement read() method.
    }

    #[\Override] public function update(AbstractDTO $DTO): void
    {
        // TODO: Implement update() method.
    }

    #[\Override] public function delete(AbstractDTO $DTO): void
    {
        // TODO: Implement delete() method.
    }
}
