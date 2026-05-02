<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DisabilityProfileResource extends JsonResource
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
            'disability_type' => $this->disability_type,
            'severity' => $this->severity,
            'description' => $this->description,
            'medical_history' => $this->medical_history,
            'medication_info' => $this->medication_info,
            'support_devices' => $this->support_devices,
            'emergency_contact' => $this->emergency_contact,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
