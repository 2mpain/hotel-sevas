<?php

namespace App\Infrastructure\Hydrators;

use App\DTO\Customer\CustomerDTO;
use App\Infrastructure\Hydrators\AbstractHydrator;
use Carbon\Carbon;

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
            $this->formatDate($customer->getArrivalDate()),
            $this->formatDate($customer->getDepartureDate()),
            $customer->getStatus()
        );
    }

    private function formatDate(?string $date): ?string
    {
        if ($date) {
            return Carbon::parse($date)->isoFormat('D MMMM YYYY');
        }

        return null;
    }
}
