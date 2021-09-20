<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ResponseResource extends JsonResource
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
            'id'      => $this->id,
            'content' => $this->content,
            'user'    => $this->user->name,
            'media'   => $this->when($request->routeIs('task.show'), MediaResource::collection(
                $this->getMedia()
            )),
        ];
    }
}
