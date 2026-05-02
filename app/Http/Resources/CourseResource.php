<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'created_by_id' => $this->created_by_id,
            'creator' => new UserResource($this->whenLoaded('creator')),
            'accessibility_level' => $this->accessibility_level,
            'target_disabilities' => $this->target_disabilities,
            'max_students' => $this->max_students,
            'is_active' => $this->is_active,
            'resources_count' => $this->whenCounted('resources'),
            'enrollments_count' => $this->whenCounted('enrollments'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
