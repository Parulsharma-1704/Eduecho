<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssessmentResource extends JsonResource
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
            'course_id' => $this->course_id,
            'course' => new CourseResource($this->whenLoaded('course')),
            'title' => $this->title,
            'description' => $this->description,
            'is_adaptive' => $this->is_adaptive,
            'time_limit' => $this->time_limit,
            'allow_extra_time' => $this->allow_extra_time,
            'allow_breaks' => $this->allow_breaks,
            'allow_assistive_tech' => $this->allow_assistive_tech,
            'questions_count' => $this->whenCounted('questions'),
            'responses_count' => $this->whenCounted('responses'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
