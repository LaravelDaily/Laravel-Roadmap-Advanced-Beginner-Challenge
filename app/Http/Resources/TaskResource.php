<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            "task_name" => $this->name,
            "project_name" => $this->whenLoaded('project')->title,
            "status" => $this->status ? 'Open' : 'Close',
            "deadline" => $this->deadline,
            "created_at" => $this->created_at,
        ];
    }
}
