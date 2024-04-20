<?php

namespace App\Infrastructure\Hydrators;

use App\DTO\Customer\CustomerDTO;
use App\Infrastructure\Hydrators\AbstractHydrator;

class CustomerDTOHydrator extends AbstractHydrator
{
    #[\Override] public function hydrate(mixed $customer): CustomerDTO
    {
        return new CustomerDTO(
            $customer->getFirstName(),
            $customer->getLastName(),
            $customer->getEmail(),
            $customer->getPhoneNumber(),
            $customer->getMiddleName(),
            $customer->getArrivalDate(),
            $customer->getDepartureDate(),
            $customer->getStatus()
        );
    }
}
