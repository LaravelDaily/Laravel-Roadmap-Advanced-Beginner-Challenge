<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\TaskResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->getRoleNames(),
            'projects' => ProjectResource::collection($this->projects),
            'tasks' => TaskResource::collection($this->tasks),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
