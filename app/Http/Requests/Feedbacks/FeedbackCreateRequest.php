<?php

namespace App\Http\Requests\Feedbacks;

use App\Http\Requests\AbstractRequest;
use Illuminate\Validation\Rule;

class FeedbackCreateRequest extends AbstractRequest
{
    #[\Override] public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:2',
                'max:20',
            ],
            'email' => [
                'required',
                'email',
            ],
            'message' => [
                'required',
                'string',
                'min:10',
            ],
            'customerId' => [
                'nullable',
                'integer',
                Rule::exists('customers', 'id'),
            ]
        ];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->request->get('name');
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->request->get('email');
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->request->get('message');
    }

    /**
     * @return int|null
     */
    public function getCustomerId(): ?int
    {
        return $this->request->get('customerId');
    }

    public function toArray(): array
    {
        return [
            'name'       => $this->getName(),
            'email'      => $this->getEmail(),
            'message'    => $this->getMessage(),
            'customerId' => $this->getCustomerId(),
        ];
    }
}
