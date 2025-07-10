<?php

namespace App\Services;

use App\Exceptions\ProjectNotFoundException;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Exception;
use Illuminate\Http\JsonResponse;


class ProjectService
{
    /**
     * @param array $data
     * @return JsonResponse
     */
    public function create(array $data): JsonResponse
    {
        try {
            $createdProject = Project::create($data);
            return response()->json([
                'status' => 'success',
                'message' => 'The Project has been successfully created.',
                'data' => new ProjectResource($createdProject),
            ], Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'The Process is unreachable.',
            ], Response::HTTP_SERVICE_UNAVAILABLE);
        }
    }

    /**
     * @throws ProjectNotFoundException
     */
    public function show(int $id): ProjectResource
    {
        try {
            $project = Project::findOrFail($id);
            return new ProjectResource($project);
        } catch (ModelNotFoundException $e) {
            throw new ProjectNotFoundException($id);
        }
    }

    /**
     * @throws ProjectNotFoundException
     */
    public function update(array $data, int $id): JsonResponse
    {
        try {
            $project = Project::findOrFail($id);
            $project->update($data);
            return response()->json([
                'status' => 'success',
                'message' => 'The Project has been successfully updated.',
                'data' => new ProjectResource($project),
            ], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            throw new ProjectNotFoundException($id);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'The Process is unreachable.',
            ], Response::HTTP_SERVICE_UNAVAILABLE);
        }
    }

    /**
     * @throws ProjectNotFoundException
     */
    public function delete(int $id): JsonResponse
    {
        try {
            $project = Project::findOrFail($id);
            $project->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'The Project has been successfully deleted.',
            ], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            throw new ProjectNotFoundException($id);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'The Process is unreachable.',
            ], Response::HTTP_SERVICE_UNAVAILABLE);
        }
    }
}
