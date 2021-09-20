<?php

namespace App\Services;

use App\Models\Response;
use App\Services\SpatieMediaLibrary\AddMediaToModel;
use Illuminate\Support\Arr;

class TaskService
{

    /**
     * @param  array  $formData
     * @return Response
     */
    public function addResponse(array $formData): Response
    {
        $data            = Arr::except($formData, ['media']);
        $data['task_id'] = decrypt($data['task_id']);
        $data['user_id'] = auth()->id();

        $task = Response::create($data);

        if (Arr::exists($formData, 'media')) {
            $addMediaToModel = new AddMediaToModel();
            $addMediaToModel($formData['media'], $task);
        }

        return $task;
    }
}
