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
        'name' => $this->name,
        'email' => $this->email,
        'contact' => $this->contact,
        'username' => $this->username,
        'roles' => $this->getRoleNames(),
        'image' => asset('storage/' . $this->image)
       ];
    }
}
