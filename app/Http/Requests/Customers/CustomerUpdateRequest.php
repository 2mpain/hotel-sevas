<?php

namespace App\Http\Requests\Customers;

use App\Enums\Customers\CustomersStatusEnum;
use App\Http\Requests\AbstractRequest;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class CustomerUpdateRequest extends AbstractRequest
{

    #[\Override] public function rules(): array
    {
        return [
            'id' => [
                'required',
                'integer',
                Rule::exists('customers', 'id')
            ],
            'firstName' => [
                'min:2',
                'max:20',
                'string',
            ],
            'lastName' => [
                'min:3',
                'max:20',
                'string',
            ],
            'middleName' => [
                'string',
                'min:5',
                'max:20',
            ],
            'email' => [
                'string',
            ],
            'phoneNumber' => [
                'string',
                'min:12',
            ],
            'arrivalDate' => [
                'string',
                'date_format:Y-m-d',
            ],
            'departureDate' => [
                'string',
                'date_format:Y-m-d'
            ],
            'status' => [
                'integer',
                Rule::in(CustomersStatusEnum::toValues())
            ],
            'roomNumber' => [
                //Rule::unique('customers', 'room_number'),
                'integer', //@todo Rule in RoomNumbersEnum
            ]
        ];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->request->get('id');
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->request->get('firstName');
    }

    /**
     * @return string|null
     */
    public function getMiddleName(): ?string
    {
        return $this->request->get('middleName');
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->request->get('lastName');
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->request->get('email');
    }

    /**
     * @return string|null
     */
    public function getPhoneNumber(): ?string
    {
        return $this->request->get('phoneNumber');
    }

    /**
     * @return Carbon|null
     */
    public function getArrivalDate(): ?Carbon
    {
        $arrivalDate = $this->request->get('arrivalDate');
        return $arrivalDate ? Carbon::createFromFormat('Y-m-d', $arrivalDate) : null;
    }

    /**
     * @return Carbon|null
     */
    public function getDepartureDate(): ?Carbon
    {
        $departureDate = $this->request->get('departureDate');
        return $departureDate ? Carbon::createFromFormat('Y-m-d', $departureDate) : null;
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->request->get('status');   
    }

    /**
     * @return int|null
     */
    public function getRoomNumber(): ?int
    {
        return $this->request->get('roomNumber');
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
            'status' => $this->getStatus(),
            'roomNumber' => $this->getRoomNumber()
        ];
    }
}
