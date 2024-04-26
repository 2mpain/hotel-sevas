<?php

namespace App\Infrastructure\Repository\Feedbacks;

use App\DTO\AbstractDTO;
use App\Infrastructure\Repository\CRUDRepositoryInterface;
use App\Models\Feedback;

class FeedbacksCRUDRepository implements CRUDRepositoryInterface
{
    private Feedback $model;

    /**
     * @return Feedback
     */
    public function getFeedbackModel(): Feedback
    {
        return $this->model;
    }

    /**
     * @param \App\Services\Feedbacks\FeedbackCreationDTO $DTO
     * @return void
     */
    #[\Override] public function create(AbstractDTO $DTO): void
    {
        $feedbackModel = new Feedback([
            'name'        => $DTO->getName(),
            'email'       => $DTO->getEmail(),
            'message'     => $DTO->getMessage(),
            'customer_id' => $DTO->getCustomerId(),
        ]);

        $feedbackModel->saveOrFail();

        $this->model = $feedbackModel;
    }

    #[\Override] public function read(AbstractDTO $DTO): void
    {
        // TODO: Implement read() method.
    }

    #[\Override] public function update(AbstractDTO $DTO): void
    {
        // TODO: Implement update() method.
    }

    #[\Override] public function delete(AbstractDTO $DTO): void
    {
    }
}
