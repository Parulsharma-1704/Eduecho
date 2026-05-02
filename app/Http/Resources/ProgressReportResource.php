<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProgressReportResource extends JsonResource
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
            'period' => $this->period,
            'academic_progress' => $this->academic_progress,
            'behavioral_progress' => $this->behavioral_progress,
            'therapy_progress' => $this->therapy_progress,
            'accessibility_recommendations' => $this->accessibility_recommendations,
            'overall_summary' => $this->overall_summary,
            'generated_by_id' => $this->generated_by_id,
            'generated_by' => new UserResource($this->whenLoaded('generatedBy')),
            'generated_at' => $this->generated_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
