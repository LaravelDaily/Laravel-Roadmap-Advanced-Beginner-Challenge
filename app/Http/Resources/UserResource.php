<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'status' => $this->verified_at ? 'Verified' : 'Unverified',
            'role' => $this->getRoleNames()->first(),
            'permissions' => $this->getAllPermissions()->select('id', 'name', 'guard_name'),
            'created_at' => $this->created_at,
        ];
    }
}
