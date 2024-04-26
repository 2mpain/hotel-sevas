<?php

namespace App\DTO\Feedback;

use App\DTO\AbstractDTO;

class FeedbackDTO extends AbstractDTO
{
    public function __construct(
        protected string   $name,
        protected string   $email,
        protected string   $message,
        protected ?int   $customerId
    ) {
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
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
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return int|null
     */
    public function getCustomerId(): ?int
    {
        return $this->customerId;
    }

    #[\Override] public function toArray(): array
    {
        $data = [
            'name'    => $this->getName(),
            'email'   => $this->getEmail(),
            'message' => $this->getMessage(),
        ];
    
        if ($this->getCustomerId() !== null) {
            $data['customerId'] = $this->getCustomerId();
        }
    
        return $data;
    }
}
