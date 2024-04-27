<?php

namespace App\Infrastructure\Repository\Feedbacks;

interface FeedbacksRepositoryInterface
{

    public function getFeedbacks(array $filters = []): array;
}
