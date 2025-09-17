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
        //'password' => $this->password,
        // 'password_confirmation' => $this->password_confirmation,
        'contact' => $this->contact,
        'username' => $this->username,
        'image' => asset('storage/' . $this->image)
       ];
    }
}
