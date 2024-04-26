<?php

namespace App\Http\Requests\Customers;

use App\Http\Requests\AbstractRequest;
use Illuminate\Validation\Rule;

class CustomerDeleteRequest extends AbstractRequest
{

    #[\Override] public function rules(): array
    {
        return [
            'customerId' => [
                'required',
                'integer',
                Rule::exists('customers', 'id'),
            ],
        ];
    }

    /**
     * @return int
     */
    public function getCustomerId(): int
    {
        return $this->request->get('customerId');
    }

}
