<?php

namespace App\Http\Requests;

use App\Rules\ProfilerInfoIdRule;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class ProfilerMedicalRequest extends FormRequest
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
    #[ArrayShape(['medical_status' => "string", 'profiler_info_id' => "array", 'medical_description' => "string"])]
    public function rules(): array
    {
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            return [
                'medical_status' => 'required|string|max:50|min:2|sometimes',
                'profiler_info_id' => ['required', 'int', new ProfilerInfoIDRule(), 'sometimes'],
                'medical_description' => 'string|max:300|min:2|sometimes',
            ];
        }

        return [
            'medical_status' => 'required|string|max:50|min:2',
            'profiler_info_id' => ['required', 'int', new ProfilerInfoIDRule(),],
            'medical_description' => 'string|max:300|min:2',
        ];
    }
}
