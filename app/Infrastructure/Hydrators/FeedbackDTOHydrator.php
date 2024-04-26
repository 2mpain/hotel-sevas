<?php

namespace App\Infrastructure\Hydrators;

use App\DTO\Feedback\FeedbackDTO;
use App\Infrastructure\Hydrators\AbstractHydrator;

class FeedbackDTOHydrator extends AbstractHydrator
{
    /**
     * @param mixed $feedback
     * @return FeedbackDTO
     */
    #[\Override] public function hydrate(mixed $feedback): FeedbackDTO
    {
        return new FeedbackDTO(
            $feedback->getName(),
            $feedback->getEmail(),
            $feedback->getMessage(),
            $feedback->getCustomerId(),
        );
    }
}
