<?php

namespace App\Http\Requests;

use App\Rules\ProfilerInfoIdRule;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class ProfilerProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[ArrayShape(['project_title' => "string", 'project_link' => "string", 'profiler_info_id' => "array", 'project_description' => "string", 'started_on' => "string", 'finished_on' => "string"])]
    public function rules(): array
    {
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            return [
                'project_title' => 'required|string|max:50|min:2|sometimes',
                'project_link' => 'required|string|min:5|sometimes',
                'profiler_info_id' => ['required', 'int', new profilerInfoIDRule(), 'sometimes'],
                'project_description' => 'required|string|max:300|min:2|sometimes',
                'started_on' => 'required|date|sometimes',
                'finished_on' => 'required|date|after:started_on|sometimes',
            ];
        }

        return [
            'project_title' => 'required|string|max:50|min:2',
            'project_link' => 'required|string|min:5',
            'profiler_info_id' => ['required', 'int', new profilerInfoIDRule(),],
            'project_description' => 'required|string|max:300|min:2',
            'started_on' => 'required|date',
            'finished_on' => 'required|date|after:started_on',
        ];
    }
}
