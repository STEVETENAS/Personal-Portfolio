<?php

namespace App\Http\Requests;

use App\Rules\ProfilerInfoIdRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfilerAcademic extends FormRequest
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
            'diploma_title' => 'required|string|max:50|min:2' . $this->profiler_academic,
            'profiler_infos_id' => ['required', 'int', new ProfilerInfoIDRule(),],
            'institution_attended' => 'required|string|max:50|min:2',
            'diploma_description' => 'required|string|max:300|min:5',
        ];
    }
}
