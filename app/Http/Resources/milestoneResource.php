<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class milestoneResource extends JsonResource
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
            'id'=>$this->id,
            'description'=>$this->description,
            'date'=>$this->date,
            'isReached'=>$this->isReached,
            'project'=>$this->project->title,
            'task'=>$this->task->title,
        ];
    }
}
