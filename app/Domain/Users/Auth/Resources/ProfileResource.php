<?php

namespace App\Domain\Users\Auth\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'phone' => $this->phone,
            'region' => $this->region,
            'city' => $this->city,
            'address' => $this->address,
            'postal_code' => $this->postal_code,
            'email' => $this->email,
            'role' => $this->getRoleNames(),
            'created_at' => $this->created_at
        ];
    }
}
