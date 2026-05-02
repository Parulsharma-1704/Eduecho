<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IEPResource extends JsonResource
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
            'student_id' => $this->student_id,
            'student' => new StudentResource($this->whenLoaded('student')),
            'created_by_id' => $this->created_by_id,
            'created_by' => new UserResource($this->whenLoaded('createdBy')),
            'status' => $this->status,
            'academic_goals' => $this->academic_goals,
            'behavioral_goals' => $this->behavioral_goals,
            'therapy_goals' => $this->therapy_goals,
            'review_date' => $this->review_date,
            'notes' => $this->notes,
            'goals_count' => $this->whenCounted('goals'),
            'accommodations_count' => $this->whenCounted('accommodations'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
