<?php

namespace App\Services\Feedbacks;

use App\Infrastructure\Repository\Feedbacks\FeedbacksRepositoryInterface;

class FeedbacksGettingService
{
    public function __construct(
        private FeedbacksRepositoryInterface $feedbacksRepository
    ) {
    }

    /**
     * @param array $filters
     * @return array
     */
    public function getFeedbacks(array $filters = []): array
    {
        $feedbacks = $this->feedbacksRepository->getFeedbacks($filters);

        return $feedbacks;
    }
}

