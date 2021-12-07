<?php

namespace App\Http\Requests;

use App\Rules\profilerInfoIDRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfilerProject extends FormRequest
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
    public function rules(): array
    {
        return [
            'project_title' => 'required|string|max:50|min:2' . $this->profiler_project,
            'project_link' => 'required|string|min:5',
            'profiler_infos_id' => ['required', 'int', new profilerInfoIDRule(),],
            'project_description' => 'required|int|max:300|min:2',
        ];
    }
}
