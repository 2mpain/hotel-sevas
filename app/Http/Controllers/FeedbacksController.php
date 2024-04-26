<?php

namespace App\Http\Controllers;

use App\DTO\Feedback\FeedbackCreationDTO;
use App\Http\Requests\Feedbacks\FeedbackCreateRequest;
use App\Models\Feedback;
use App\Response\AbstractResponse;
use App\Services\Feedbacks\FeedbackCreationService;
use Illuminate\Http\Request;

class FeedbacksController extends Controller
{

    /**
     * @param \App\Http\Requests\Feedbacks\FeedbackCreateRequest $request
     * @param \App\Services\Feedbacks\FeedbackCreationService $feedbackCreationService
     * @return AbstractResponse
     */
    public function createFeedback(
        FeedbackCreateRequest $request,
        FeedbackCreationService $feedbackCreationService
    ): AbstractResponse {
        $request->validate();

        $dto = new FeedbackCreationDTO(
            $request->getName(),
            $request->getEmail(),
            $request->getMessage()
        );

        $feedback = $feedbackCreationService->create($dto);

        return new AbstractResponse(
            [
                'result' => true,
                'feedback' => $feedback,
            ],
            200
        );
    }
}
