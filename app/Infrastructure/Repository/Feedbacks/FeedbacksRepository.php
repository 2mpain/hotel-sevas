<?php

namespace App\Infrastructure\Repository\Feedbacks;

use App\Models\Feedback;
use Carbon\Carbon;

class FeedbacksRepository implements FeedbacksRepositoryInterface
{

    /**
     * @return array
     */
    #[\Override] public function getFeedbacks(array $filters = []): array
    {
        $query = Feedback::query();

        if (isset($filters['id'])) {
            $query->where(['id' => $filters['id']]);
        }

        if (isset($filters['name'])) {
            $query->where('name', 'like', "%{$filters['name']}%");
        }

        if (isset($filters['email'])) {
            $query->where('email', 'like', "%{$filters['email']}%");
        }

        if (isset($filters['message'])) {
            $query->where('message', 'like', "%{$filters['message']}%");
        }

        if (isset($filters['new']) && $filters['new'] === true) {
            $query->where(
                'created_at',
                '>=',
                Carbon::now()->subDay()
            );
        }

        if (isset($filters['dateStart']) && isset($filters['dateEnd'])) {
            $dateStart = Carbon::parse($filters['dateStart']);
            $dateEnd = Carbon::parse($filters['dateEnd']);
            $query->whereBetween(
                'created_at',
                [
                    $dateStart,
                    $dateEnd,
                ]
            )
                ->whereBetween('created_at', [
                    $dateStart,
                    $dateEnd,
                ]);
        } else if (isset($filters['dateStart'])) {
            $dateStart = Carbon::parse($filters['dateStart']);
            $query->whereDate('created_at', $dateStart);
        } else if (isset($filters['dateEnd'])) {
            $dateEnd = Carbon::parse($filters['dateEnd']);
            $query->whereDate('created_at', $dateEnd);
        }

        if (isset($filters['customerId'])) {
            $query->where('customer_id', $filters['customerId']);
        }

        $feedbacks = $query->get()->toArray();

        return [
            'total'     =>  $this->getFeedbacksCount(),
            'feedbacks' =>  $feedbacks,
        ];
    }

    /**
     * @return int
     */
    #[\Override] public function getFeedbacksCount(): int
    {
        return Feedback::count();
    }

    /**
     * @param int $id
     * @return Feedback
     */
    #[\Override] public function getFeedbackById(int $id): Feedback
    {
        return Feedback::query()->where(['id' => $id])->firstOrFail();
    }
}
