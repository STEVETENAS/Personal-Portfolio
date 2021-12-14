<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfilerProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'profiler_info' => profilerInfoResource::make($this->profilerInfos),
            'project_title' => $this->project_title,
            'project_link' => $this->project_link,
            'project_description' => $this->project_description,
            'started_on' => $this->started_on,
            'finished_on' => $this->finished_on,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
