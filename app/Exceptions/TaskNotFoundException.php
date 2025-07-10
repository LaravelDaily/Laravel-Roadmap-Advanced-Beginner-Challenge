<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class TaskNotFoundException extends Exception
{
    protected int $taskId;
    public function __construct(int $taskId)
    {
        $this->taskId = $taskId;
        parent::__construct();
    }

    public function report(): bool
    {
        return false;
    }

    public function render(): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => "The Task ID: $this->taskId is not found.",
        ], Response::HTTP_NOT_FOUND);
    }
}
