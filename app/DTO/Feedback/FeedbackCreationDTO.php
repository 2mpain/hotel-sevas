<?php

namespace App\DTO\Feedback;

use App\DTO\AbstractDTO;

class FeedbackCreationDTO extends AbstractDTO
{
    public function __construct(
        private string $name,
        private string $email,
        private string $message,
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
     * @return array
     */
    #[\Override] public function toArray(): array
    {
        return [
            'name'    => $this->getName(),
            'email'   => $this->getEmail(),
            'message' => $this->getMessage(),
        ];
    }
}
