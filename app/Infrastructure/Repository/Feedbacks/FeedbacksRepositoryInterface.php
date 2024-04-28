<?php

namespace App\Infrastructure\Repository\Feedbacks;

use App\Models\Feedback;

interface FeedbacksRepositoryInterface
{

    public function getFeedbacks(array $filters = []): array;

    public function getFeedbacksCount(): int;

    public function getFeedbackById(int $id): Feedback;
}
