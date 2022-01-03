<?php

namespace App\Http\Requests;

use App\Rules\ProfilerInfoIdRule;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class ProfilerSkillRequest extends FormRequest
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
    #[ArrayShape(['skill_title' => "string", 'profiler_info_id' => "array", 'skill_level' => "string", 'skill_description' => "string"])]
    public function rules(): array
    {
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            return [
                'skill_title' => 'required|string|max:50|min:2|sometimes',
                'profiler_info_id' => ['required', 'int', new profilerInfoIDRule(), 'sometimes'],
                'skill_level' => 'required|int|max:100|min:1|sometimes',
                'skill_description' => 'required|string|max:300|min:2|sometimes',
            ];
        }

        return [
            'skill_title' => 'required|string|max:50|min:2',
            'profiler_info_id' => ['required', 'int', new profilerInfoIDRule(),],
            'skill_level' => 'required|int|max:100|min:1',
            'skill_description' => 'required|string|max:300|min:2',
        ];
    }
}
