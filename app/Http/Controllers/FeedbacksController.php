<?php

namespace App\Http\Controllers;

use App\DTO\Feedback\FeedbackCreationDTO;
use App\Http\Requests\Feedbacks\FeedbackCreateRequest;
use App\Http\Requests\Feedbacks\FeedbackDeleteRequest;
use App\Http\Requests\Feedbacks\FeedbacksSearchRequest;
use App\Http\Requests\Feedbacks\FeedbackUpdateRequest;
use App\Models\Feedback;
use App\Response\AbstractResponse;
use App\Services\Feedbacks\FeedbackCreationService;
use App\Services\Feedbacks\FeedbackDeletionService;
use App\Services\Feedbacks\FeedbackSettingsGettingService;
use App\Services\Feedbacks\FeedbackSettingsUpdateService;

class FeedbacksController extends Controller
{

    /**
     * @param \App\Http\Requests\Feedbacks\FeedbacksSearchRequest $request
     * @param \App\Services\Feedbacks\FeedbackSettingsGettingService $feedbackSettingsGettingService
     * @return AbstractResponse
     */
    public function getFeedbacks(
        FeedbacksSearchRequest $request,
        FeedbackSettingsGettingService $feedbacksGettingService
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
     * @param \App\Http\Requests\Feedbacks\FeedbackUpdateRequest $request
     * @param \App\Services\Feedbacks\FeedbackSettingsGettingService $feedbackSettingsGettingService
     * @param \App\Services\Feedbacks\FeedbackSettingsUpdateService $feedbackSettingsUpdateService
     * @return AbstractResponse
     */
    public function updateFeedback(
        FeedbackUpdateRequest $request,
        FeedbackSettingsGettingService $feedbackSettingsGettingService,
        FeedbackSettingsUpdateService $feedbackSettingsUpdateService,
    ): AbstractResponse {
        $request->validate();

        $feedback = $feedbackSettingsGettingService->getFeedback(
            $request->getId()
        );

        $feedbackSettingsUpdateService->updateFeedback(
            $request,
            $feedback
        );

        return new AbstractResponse([
            'result' => true,
            'updatedFeedback' => $feedback,
        ], 200);
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
