<?php

namespace App\Services\Feedbacks;

use App\Http\Requests\Feedbacks\FeedbackUpdateRequest;
use App\Infrastructure\Mutators\Feedbacks\FeedbackSettingsMutatorInterface;
use App\Models\Feedback;

class FeedbackSettingsUpdateService
{

    public function __construct(
        private FeedbacksettingsMutatorInterface $feedbackSettingsMutator,
    ) {
    }

    /**
     * @param FeedbackUpdateRequest $request
     * @param Feedback $feedback
     * @return void
     */
    public function updateFeedback(
        FeedbackUpdateRequest $request,
        Feedback $feedback
    ): void {
        $this->feedbackSettingsMutator->updateFeedback(
            array_filter($request->toArray()),
            $feedback
        );
    }
}
