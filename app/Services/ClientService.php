<?php

namespace App\Services;

use App\Exceptions\ClientNotFoundException;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;


class ClientService
{
    public function create(array $data): JsonResponse
    {
        $client = Client::create($data);
        return response()->json([
            'status' => 'success',
            'message' => 'The client has been successfully created.',
            'data' => new ClientResource($client)
        ], Response::HTTP_CREATED);
    }
    /**
     * @param int $id
     * @return ClientResource
     * @throws ClientNotFoundException
     */
    public function show(int $id): ClientResource
    {
        try {
            $client = Client::findOrFail($id);
            return new ClientResource($client);
        } catch (ModelNotFoundException $e) {
            throw new ClientNotFoundException($id);
        }
    }

    /**
     * @param array $data
     * @param int $id
     * @return JsonResponse
     * @throws ClientNotFoundException
     */
    public function update(array $data, int $id): JsonResponse
    {
        try {
            $client = Client::findOrFail($id);
            $client->update($data);
            return response()->json([
                'status' => 'success',
                'message' => 'The client has been successfully updated.',
                'data' => new ClientResource($client)
            ], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            throw new ClientNotFoundException($id);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'The Process is unreachable.',
            ], Response::HTTP_SERVICE_UNAVAILABLE);
        }
    }

    /**
     * @throws ClientNotFoundException
     */
    public function delete(int $id): JsonResponse
    {
        try {
            $client = Client::findOrFail($id);
            $client->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'The client has been successfully deleted.'
            ], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            throw new ClientNotFoundException($id);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'The Process is unreachable.',
            ], Response::HTTP_SERVICE_UNAVAILABLE);
        }
    }
}
