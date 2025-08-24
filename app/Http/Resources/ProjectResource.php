<?php

namespace App\Http\Resources;

use App\Http\Resources\ClientResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            "client_id" => new ClientResource( $this->client ),
            "user_id" => $this->user,
            "title" => $this->title,
            "description" => $this->description,
            "deadline" => $this->deadline,
            "status" => $this->status
        ];
    }
}
