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
          'title' => $this->title,
          'description' => $this->description,
          'priority' => $this->priority,
          'status' => $this->status,
          'client_id' => $this->client_id,
          'user_id' => $this->user_id,
          'project_id' => $this->project_id,
        ];
    }
}
