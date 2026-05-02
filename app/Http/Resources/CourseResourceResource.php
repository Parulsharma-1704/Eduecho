<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResourceResource extends JsonResource
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
            'resource_type' => $this->resource_type,
            'title' => $this->title,
            'description' => $this->description,
            'file_path' => $this->file_path,
            'has_captions' => $this->has_captions,
            'has_transcript' => $this->has_transcript,
            'has_audio_description' => $this->has_audio_description,
            'text_size_options' => $this->text_size_options,
            'high_contrast_version' => $this->high_contrast_version,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
