<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfilerInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $path = str_replace('public','/storage',$this->profiler_image);
        $path1 = str_replace('public','/storage',$this->background_image);
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'gender' => $this->gender,
            'place_of_birth' => $this->place_of_birth,
            'date_of_birth' => $this->date_of_birth,
            'profession' => $this->profession,
            'place_of_origin' => $this->place_of_origin,
            'number_of_children' => $this->number_of_children,
            'married' => $this->married ? "Yes" : "No",
            'profiler_image' => $this->profiler_image,
            'background_image' => $this->background_image,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
