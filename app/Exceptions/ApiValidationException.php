<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class ApiValidationException extends ValidationException
{
    public function render(...$args)
    {
        return new JsonResponse(
            $this->errors(),
            $this->status
        );
    }
}