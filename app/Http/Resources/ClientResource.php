<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class ClientResource extends JsonResource
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
            'name'=>$this->name,
            'vat_id'=>$this->vat_id,
            'zip_code'=>$this->zip_code,
            'city'=>$this->city,
            'address'=>$this->address,
            'projects'=> ProjectResource::collection($this->projects)
        ];
    }
}
