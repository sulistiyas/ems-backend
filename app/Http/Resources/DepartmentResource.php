<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'description' => $this->description,
            'head_id' => $this->head_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'head' => new EmployeeResource($this->whenLoaded('head')),
            'employees' => EmployeeResource::collection($this->whenLoaded('employees')),
        ];
    }
}
