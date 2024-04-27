<?php

namespace App\Http\Controllers;

use App\DTO\Feedback\FeedbackCreationDTO;
use App\Http\Requests\Feedbacks\FeedbackCreateRequest;
use App\Http\Requests\Feedbacks\FeedbacksSearchRequest;
use App\Response\AbstractResponse;
use App\Services\Feedbacks\FeedbackCreationService;

class FeedbacksController extends Controller
{

    /**
     * @param \App\Http\Requests\Feedbacks\FeedbacksSearchRequest $request
     * @return AbstractResponse
     */
    public function getFeedbacks(FeedbacksSearchRequest $request): AbstractResponse
    {
        $request->validate();
        return new AbstractResponse('', 200);
    }
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
