<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'id'         => $this->id,
            'name'       => $this->name,
            'email'      => $this->email,
            'is_admin'   => $this->isAdmin(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            $this->mergeWhen($request->routeIs('user.show', 'user.update'), [
                'roles'       => $this->getRoleNames(),
                'permissions' => $this->getAllPermissions()->pluck('name'),
            ]),
        ];
    }
}
