<?php

namespace App\Infrastructure\Mutators\Feedbacks;

use App\Models\Feedback;

interface FeedbackSettingsMutatorInterface
{
    public function updateFeedback(array $feedbackData, Feedback $feedback): void;
}
