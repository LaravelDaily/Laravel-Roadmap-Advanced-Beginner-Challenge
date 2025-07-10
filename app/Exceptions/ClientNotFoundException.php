<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class ClientNotFoundException extends Exception
{
    protected int $clientId;
    public function __construct(int $clientId)
    {
        $this->clientId = $clientId;
        parent::__construct();
    }

    public function report(): bool
    {
        return false;
    }

    public function render(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => "The Client ID: $this->clientId is not found.",
        ], Response::HTTP_NOT_FOUND);
    }
}
