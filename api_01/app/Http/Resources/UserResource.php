<?php

namespace App\Http\Resources;

use Illuminate\Container\Attributes\Auth;
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
        $data = parent::toArray($request);
        $data['display_name'] = $this->name . ' (' . $this->email . ')';
        unset($data['id']);
        return $data;
    }
}
