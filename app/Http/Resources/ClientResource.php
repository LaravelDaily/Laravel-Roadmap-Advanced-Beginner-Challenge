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
          'id' => $this->id,
          'title' => $this->title_company,
          'description' => $this->description_company,
          'vat' => $this->vat_company,
          'zip' => $this->zip_company,
          'name' => $this->name_manager,
          'email' => $this->email_manager,
          'phone' => $this->phone_manager,
          'address' => $this->address_company,
          'city' => $this->city_company,
        ];
    }
}
