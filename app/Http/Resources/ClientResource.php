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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'company' => $this->company,
            'email' => $this->email,
            'phone' => $this->phone,
            'country' => $this->country,
            'client_status' => $this->client_status
        ];
    }
}
