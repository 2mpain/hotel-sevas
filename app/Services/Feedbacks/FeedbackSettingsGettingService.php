<?php

namespace App\Services\Feedbacks;

use App\Infrastructure\Repository\Feedbacks\FeedbacksRepositoryInterface;
use App\Models\Feedback;

class FeedbackSettingsGettingService
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

    /**
     * @param int $feedbackId
     * @return Feedback
     */
    public function getFeedback(int $feedbackId): Feedback
    {
        return $this->feedbacksRepository->getFeedbackById($feedbackId);
    }
}

