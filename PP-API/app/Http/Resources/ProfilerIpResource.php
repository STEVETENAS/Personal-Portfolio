<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfilerIpResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $path = str_replace('public','/storage',$this->ip_img);
        return [
            'id' => $this->id,
            'ip_name' => $this->ip_name,
            'ip_description' => $this->ip_description,
            'ip_img' => $path,
            'profiler_info' => profilerInfoResource::make($this->profilerInfo),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
