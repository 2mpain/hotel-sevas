<?php

namespace App\Http\Controllers;

use App\DTO\Feedback\FeedbackCreationDTO;
use App\Http\Requests\Feedbacks\FeedbackCreateRequest;
use App\Http\Requests\Feedbacks\FeedbackDeleteRequest;
use App\Http\Requests\Feedbacks\FeedbacksSearchRequest;
use App\Response\AbstractResponse;
use App\Services\Feedbacks\FeedbackCreationService;
use App\Services\Feedbacks\FeedbackDeletionService;
use App\Services\Feedbacks\FeedbacksGettingService;

class FeedbacksController extends Controller
{

    /**
     * @param \App\Http\Requests\Feedbacks\FeedbacksSearchRequest $request
     * @return AbstractResponse
     */
    public function getFeedbacks(
        FeedbacksSearchRequest $request,
        FeedbacksGettingService $feedbacksGettingService
    ): AbstractResponse {
        $request->validate();

        $customers = $feedbacksGettingService->getFeedbacks($request->toArray());

        return new AbstractResponse($customers, 200);
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

    /**
     * @param \App\Http\Requests\Feedbacks\FeedbackDelete $request
     * @param \App\Services\Feedbacks\FeedbackDeletionService $feedbackDeletionService
     * @return AbstractResponse
     */
    public function deleteFeedback(
        FeedbackDeleteRequest $request,
        FeedbackDeletionService $feedbackDeletionService
    ): AbstractResponse {
        $request->validate();

        $feedback = $feedbackDeletionService->delete($request->getId());

        return new AbstractResponse(['result' => true, 'deletedFeedback' => $feedback], 200);
    }
}
