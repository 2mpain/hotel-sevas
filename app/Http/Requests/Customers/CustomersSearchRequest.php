<?php

namespace App\Http\Requests\Customers;

use App\Enums\Customers\CustomersStatusEnum;
use App\Http\Requests\AbstractRequest;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class CustomersSearchRequest extends AbstractRequest
{

    #[\Override] public function rules(): array
    {
        return [
            'name' => 'string',
            'new' => 'bool',
            'arrivalDate' => 'date_format:Y-m-d',
            'departureDate' => 'date_format:Y-m-d',
            'phoneNumber' => 'string',
            'status' => [
                'integer', 
                Rule::in(CustomersStatusEnum::toValues())
            ],
        ];
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->request->get('name');
    }

    /**
     * @return bool
     */
    public function getNew(): bool
    {
        return (bool) $this->request->get('new', false);
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
     * @return string|null
     */
    public function getPhoneNumber(): ?string
    {
        return (string) $this->request->get('phoneNumber');
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->request->get('status');
    }

    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'new' => $this->getNew(),
            'arrivalDate' => $this->getArrivalDate(),
            'departureDate' => $this->getDepartureDate(),
            'phoneNumber' => $this->getPhoneNumber(),
            'status' => $this->getStatus(),
        ];
    }
}
