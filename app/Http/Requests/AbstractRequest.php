<?php

namespace App\Http\Requests;

use App\Exceptions\ApiValidationException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

abstract class AbstractRequest
{
    protected array $data = [];

    public function __construct(protected Request $request)
    {
    }

    public function validate(array $data = []): array
    {
        $data = $data ?: $this->request->all();

        try {
            return $this->request->validate(
                $this->rules(),
                $data
            );
        } catch (ValidationException $exception) {
            $newException = new ApiValidationException($exception->validator, $exception->response, $exception->errorBag);
            throw $newException;
        }
    }

    abstract public function rules(): array;

    public function getUserAgentFingerprint(): string
    {
        return md5($this->request->userAgent());
    }
}