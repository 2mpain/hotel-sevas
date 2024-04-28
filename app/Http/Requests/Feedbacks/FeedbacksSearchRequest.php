<?php

namespace App\Http\Requests\Feedbacks;

use App\Http\Requests\AbstractRequest;
use Carbon\Carbon;

class FeedbacksSearchRequest extends AbstractRequest
{

    #[\Override] public function rules(): array
    {
        return [
            'id'            => 'integer',
            'name'          => 'string',
            'email'         => 'string',
            'message'       => 'string',
            'new'           => 'bool',
            'dateStart'     => 'date_format:Y-m-d',
            'dateEnd'       => 'date_format:Y-m-d',   
            'customerId'    => 'integer'   
        ];
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
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
     * @return bool
     */
    public function getNew(): bool
    {
        return (bool) $this->request->get('new', false);
    }

    /**
     * @return Carbon|null
     */
    public function getDateStart(): ?Carbon
    {
        $dateStart = $this->request->get('dateStart');
        return $dateStart ? Carbon::createFromFormat('Y-m-d', $dateStart) : null;
    }

    /**
     * @return Carbon|null
     */
    public function getDateEnd(): ?Carbon
    {
        $dateEnd = $this->request->get('dateEnd');
        return $dateEnd ? Carbon::createFromFormat('Y-m-d', $dateEnd) : null;
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
            'id'         => $this->getId(),
            'name'       => $this->getName(),
            'email'      => $this->getEmail(),
            'message'    => $this->getMessage(),
            'new'        => $this->getNew(),    
            'dateStart'  => $this->getDateStart(),
            'dateEnd'    => $this->getDateEnd(),
            'customerId' => $this->getCustomerId(),
        ];
    }
}
