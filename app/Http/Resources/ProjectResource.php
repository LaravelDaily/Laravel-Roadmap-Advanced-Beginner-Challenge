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
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'deadline' => $this->deadline,
            'user_id' => $this->user_id,
            'user_name' => $this->user->name,
            'client_id' => $this->client_id,
            "client_name" => $this->client->company,
            "status" => $this->status ? 'Open' : 'Close',
            "created_at" => $this->created_at,
        ];
    }
}
