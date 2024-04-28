<?php

namespace App\Infrastructure\Mutators\Feedbacks;

use App\Models\Feedback;

class FeedbackSettingsMutator implements FeedbackSettingsMutatorInterface
{

    /**
     * @param array $feedbackData
     * @param Feedback $feedback
     * @return void
     */
    #[\Override] public function updateFeedback(array $feedbackData, Feedback $feedback): void
    {
        if (isset($feedbackData['name'])) {
            $feedback->setName($feedbackData['name']);
        }

        if(isset($feedbackData['email'])){
            $feedback->setEmail($feedbackData['email']);
        }

        if(isset($feedbackData['message'])){
            $feedback->setMessage($feedbackData['message']);
        }

        if(isset($feedbackData['customerId'])){
            $feedback->setCustomerId($feedbackData['customerId']);
        }

        if(isset($feedbackData['createdAt'])){
            $feedback->setCreatedAt($feedbackData['createdAt']);
        }

        $feedback->saveOrFail();
    }
}
