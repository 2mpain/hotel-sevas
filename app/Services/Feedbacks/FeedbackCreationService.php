<?php

namespace App\Services\Feedbacks;

use App\DTO\Feedback\FeedbackCreationDTO;
use App\DTO\Feedback\FeedbackDTO;
use App\Infrastructure\Hydrators\FeedbackDTOHydrator;
use App\Infrastructure\Repository\Feedbacks\FeedbacksCRUDRepository;

class FeedbackCreationService
{
    public function __construct(
        private FeedbacksCRUDRepository $feedbacksCRUDRepository,
        private FeedbackDTOHydrator $feedbackDTOHydrator,
    ) {
    }


    /**
     * @param FeedbackCreationDTO $feedbackCreationDTO
     * @return FeedbackDTO
     */
    public function create(FeedbackCreationDTO $feedbackCreationDTO): FeedbackDTO
    {
        try {
            $this->feedbacksCRUDRepository->create($feedbackCreationDTO);
            $model = $this->feedbacksCRUDRepository->getFeedbackModel();
            $dto = $this->feedbackDTOHydrator->hydrate($model);

            return $dto;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
}
