<?php

namespace App\DTO\Customer;

use App\DTO\AbstractDTO;

class CustomerDTO extends AbstractDTO
{
    public function __construct(
        protected string   $firstName,
        protected string   $lastName,
        protected string   $email,
        protected string   $phoneNumber,
        protected ?string  $middleName,
        protected ?string  $arrivalDate,
        protected ?string  $departureDate,
        protected int|string      $status,
        protected ?int     $id = null,
    ) {
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function setMiddleName(string $middleName): self
    {
        $this->$middleName = $middleName;

        return $this;
    }

    public function setArrivalDate(string $arrivalDate): self
    {
        $this->arrivalDate = $arrivalDate;

        return $this;
    }

    public function setDepartureDate(string $departureDate): self
    {
        $this->departureDate = $departureDate;

        return $this;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    public function getArrivalDate(): ?string
    {
        return $this->arrivalDate;
    }

    public function getDepartureDate(): ?string
    {
        return $this->departureDate;
    }

    public function getStatus(): int|string
    {
        return $this->status;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    #[\Override] public function toArray(): array
    {
        return [
            'firstName'     => $this->getFirstName(),
            'middleName'    => $this->getMiddleName(),
            'lastName'      => $this->getLastName(),
            'email'         => $this->getEmail(),
            'phoneNumber'   => $this->getPhoneNumber(),
            'arrivalDate'   => $this->getArrivalDate(),
            'departureDate' => $this->getDepartureDate(),
            'status'        => $this->getStatus(),
        ];
    }
}
