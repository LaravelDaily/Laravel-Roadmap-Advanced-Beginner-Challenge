<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

class ProjectNotFoundException extends Exception
{
    protected int $projectId;
    public function __construct(int $projectId)
    {
        $this->projectId = $projectId;
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
            'message' => "The Project ID: $this->projectId is not found.",
        ], Response::HTTP_NOT_FOUND);
    }
}
