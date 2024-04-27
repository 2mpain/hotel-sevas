<?php

namespace App\Services\Feedbacks;

use App\DTO\Feedback\FeedbackDTO;
use App\Infrastructure\Hydrators\FeedbackDTOHydrator;
use App\Infrastructure\Repository\Feedbacks\FeedbacksCRUDRepository;
use App\Infrastructure\Repository\Feedbacks\FeedbacksRepository;

class FeedbackDeletionService
{
    public function __construct(
        private FeedbacksCRUDRepository $feedbacksCRUDRepository,
        private FeedbacksRepository $feedbacksRepository,
        private FeedbackDTOHydrator $feedbackDTOHydrator
    ) {

    }

    /**
     * @param int $feedbackId
     * @return FeedbackDTO
     */
    public function delete(int $feedbackId): FeedbackDTO
    {
        try {
            $feedback = $this->feedbacksRepository->getFeedbackById($feedbackId);

            $dto = new FeedbackDTO(
                $feedback->getName(),
                $feedback->getEmail(),
                $feedback->getMessage(),
                $feedback->getCustomerId(),
                $feedback->getId()
            );

            $this->feedbacksCRUDRepository->delete($dto);

            $model = $this->feedbackDTOHydrator->hydrate($feedback);

            return $model;
        } catch (\Throwable $err) {
            throw new \Exception($err->getMessage());
        }

    }
}
