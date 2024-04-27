<?php

namespace App\Http\Requests\Feedbacks;

use App\Http\Requests\AbstractRequest;
use Illuminate\Validation\Rule;

class FeedbackDeleteRequest extends AbstractRequest
{

    #[\Override] public function rules(): array
    {
        return [
            'id' => [
                'required',
                'integer',
                Rule::exists('feedbacks', 'id'),
            ],
        ];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->request->get('id');
    }

}
