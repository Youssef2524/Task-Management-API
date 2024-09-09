<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'task_id' => $this->task_id,
            'title' => $this->title,
            'description' => $this->description,
            'priority' => $this->priority,
            'due_date' => $this->due_date,
            'status' => $this->status,
            'assigned_to' => new UserResource($this->user),  // Include the assigned user
            'created_on' => $this->created_on->format('Y-m-d H:i:s'),
            'updated_on' => $this->updated_on->format('Y-m-d H:i:s'),
        ];    }
}
