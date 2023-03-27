<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request)
  {
    return [
      'id' => $this->id,
      'title' => $this->title,
      'company' => $this->company,
      'description' => $this->description,
      'salary' => $this->salary,
      'tag' => $this->tag,
    ];
  }
}
