<?php

namespace App\DTO\Customer;

use App\DTO\AbstractDTO;

class CustomerCreationDTO extends AbstractDTO
{
    // private ?string $middleName;

    public function __construct(
        private string $firstName,
        private string $lastName,
        private string $email,
        private string $phoneNumber,
        private int $status,
        private ?string $middleName = null,
        private ?string $arrivalDate = null,
        private ?string $departureDate = null,
    ) {
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @return string|null
     */
    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    /**
     * @return string|null
     */
    public function getArrivalDate(): ?string
    {
        return $this->arrivalDate;
    }

    /**
     * @return string|null
     */
    public function getDepartureDate(): ?string
    {
        return $this->departureDate;
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @return array
     */
    #[\Override] public function toArray(): array
    {
        return [
            'first_name' => $this->getFirstName(),
            'middle_name' => $this->getMiddleName(),
            'last_name' => $this->getLastName(),
            'email' => $this->getEmail(),
            'phoneNumber' => $this->getPhoneNumber(),
            'arrivalDate' => $this->getArrivalDate(),
            'departureDate' => $this->getDepartureDate(),
            'status' => $this->getStatus(),
        ];
    }
}
