<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (string) $this->id,
            'company' => $this->company,
            'vat' => $this->vat,
            'address' => $this->address,
            'user' => $this->clientable->name,
            'becameAClient' => $this->created_at
        ];
    }
}
