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
      // 'is_super_admin' => $this->is_super_admin,
      'roles' => $this->roles()->select('id', 'name')->get(),
      'permissions' => $this->getAllPermissions()->pluck('name'),
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
    ];
  }
}
