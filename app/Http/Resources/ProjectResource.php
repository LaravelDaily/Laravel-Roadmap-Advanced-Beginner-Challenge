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
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->contact_email,
            'user_id' => $this->user_id,
            'client' => $this->client->name ?? null,
            'deadline' => $this->deadline,
            'status' => $this->status,
        ];
    }
}
