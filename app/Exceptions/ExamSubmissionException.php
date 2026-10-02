<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Traits\ApiResponder;

class ExamSubmissionException extends Exception
{
    use ApiResponder;
    public function __construct(string $message = "Some error occurred while submitting the exam", int $code = 400)
    {
        parent::__construct($message, $code);
    }

    public function render(Request $request): JsonResponse
    {
        return $this->respondWithError($this->getMessage(), $this->getCode());
    }
}
