<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class projectResource extends JsonResource
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
            'title'=>$this->title,
            'description'=>$this->description,
            'deadline'=>$this->deadline,
            'assigned user '=>$this->user->name,
            'assigned client '=>$this->client->name,
            'status'=>$this->status,
            'department_id'=>$this->department->title ?? ''
        ];
    }
}
