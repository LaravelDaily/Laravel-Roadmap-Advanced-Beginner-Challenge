<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (string) $this->id,
            'title' => $this->title,
            'deadline' => $this->deadline,
            'user' => $this->whenLoaded('user', $this->user->name),
            'client' => $this->whenLoaded('client', $this->client->company),
            'status' => $this->status,
            'TaskStarted' => $this->created_at,
        ];
    }
}
