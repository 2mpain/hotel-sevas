<?php

namespace App\Http\Requests\Customers;

use App\Enums\Customers\CustomersStatusEnum;
use App\Http\Requests\AbstractRequest;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class CustomerCreateRequest extends AbstractRequest
{
    #[\Override] public function rules(): array
    {
        return [
            'firstName' => [
                'required',
                'min:2',
                'max:20',
                'string',
            ],
            'lastName' => [
                'required',
                'min:3',
                'max:20',
                'string',
            ],
            'middleName' => [
                'nullable',
                'string',
                'min:5',
                'max:20',
            ],
            'email' => [
                'required',
                'string',
            ],
            'phoneNumber' => [
                'required',
                'string',
                'min:12',
            ],
            'arrivalDate' => [
                'string'
            ],
            'departureDate' => [
                'string'
            ],
            'status' => [
                'integer',
                Rule::in(CustomersStatusEnum::toValues())
            ]
        ];
    }

    public function getFirstName(): string
    {
        return $this->request->get('firstName');
    }

    public function getMiddleName(): ?string
    {
        return $this->request->get('middleName');
    }

    public function getLastName(): string
    {
        return $this->request->get('lastName');
    }

    public function getEmail(): string
    {
        return $this->request->get('email');
    }

    public function getPhoneNumber(): string
    {
        return $this->request->get('phoneNumber');
    }

    public function getArrivalDate(): ?Carbon
    {
        $arrivalDate = $this->request->get('arrivalDate');
        return $arrivalDate ? Carbon::createFromFormat('Y-m-d', $arrivalDate) : null;
    }

    public function getDepartureDate(): ?Carbon
    {
        $departureDate = $this->request->get('departureDate');
        return $departureDate ? Carbon::createFromFormat('Y-m-d', $departureDate) : null;
    }

    public function getStatus(): int
    {
        return $this->request->get('status', CustomersStatusEnum::STATUS_LEFT_A_REQUEST);   
    }
    

    public function toArray(): array
    {
        return [
            'firstName' => $this->getFirstName(),
            'middleName' => $this->getMiddleName(),
            'lastName' => $this->getLastName(),
            'email' => $this->getEmail(),
            'phoneNumber' => $this->getPhoneNumber(),
            'arrivalDate' => $this->getArrivalDate(),
            'departureDate' => $this->getDepartureDate(),
            'status' => $this->getStatus()
        ];
    }
}
