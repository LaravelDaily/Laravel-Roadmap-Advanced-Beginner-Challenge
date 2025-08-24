<?php

namespace App\Http\Resources;

use App\Http\Resources\ProjectResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'project_id' => new ProjectResource( $this->project ),
            'name' => $this->name,
            'description' => $this->description,
            'completed' => $this->completed
        ];
    }
}
