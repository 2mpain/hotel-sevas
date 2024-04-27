<?php

namespace App\Http\Requests\Feedbacks;

use App\Http\Requests\AbstractRequest;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class FeedbackUpdateRequest extends AbstractRequest
{
    #[\Override] public function rules(): array
    {
        return [
            'id' => [
                'required',
                Rule::exists('feedbacks', 'id'),
            ],
            'name' => [
                'string',
                'min:2',
                'max:20',
            ],
            'email' => [
                'email',
            ],
            'message' => [
                'string',
                'min:10',
            ],
            'customerId' => [
                'integer',
                Rule::exists('customers', 'id'),
            ],
            'createdAt' => [
                'date_format:Y-m-d'
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
    public function getName(): ?string
    {
        return $this->request->get('name');
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
    public function getMessage(): ?string
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

    /**
     * @return Carbon|null
     */
    public function getCreatedAt(): ?Carbon
    {
        $createdAt = $this->request->get('createdAt');
        return $createdAt ? Carbon::createFromFormat('Y-m-d', $createdAt) : null;
    }

    public function toArray(): array
    {
        return [
            'id'         => $this->getId(),
            'name'       => $this->getName(),
            'email'      => $this->getEmail(),
            'message'    => $this->getMessage(),
            'customerId' => $this->getCustomerId(),
            'createdAt'  => $this->getCreatedAt()
        ];
    }
}
