<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AccessibilityProfileResource extends JsonResource
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
            'font_size' => $this->font_size,
            'font_family' => $this->font_family,
            'line_spacing' => $this->line_spacing,
            'letter_spacing' => $this->letter_spacing,
            'high_contrast' => $this->high_contrast,
            'invert_colors' => $this->invert_colors,
            'text_to_speech' => $this->text_to_speech,
            'screen_reader_mode' => $this->screen_reader_mode,
            'voice_control' => $this->voice_control,
            'keyboard_only' => $this->keyboard_only,
            'reading_guide' => $this->reading_guide,
            'focus_mode' => $this->focus_mode,
            'color_scheme' => $this->color_scheme,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
