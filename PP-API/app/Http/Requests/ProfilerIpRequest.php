<?php

namespace App\Http\Requests;

use App\Rules\ProfilerInfoIdRule;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class ProfilerIpRequest extends FormRequest
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
    #[ArrayShape(['ip_name' => "string", 'profiler_info_id' => "array", 'ip_description' => "string", 'ip_img' => "string[]"])]
    public function rules(): array
    {
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            return [
                'ip_name' => 'required|string|max:50|min:2|sometimes',
                'profiler_info_id' => ['required', 'int', new ProfilerInfoIDRule(), 'sometimes'],
                'ip_description' => 'nullable|required|string|max:300|min:5|sometimes',
                'ip_img' => 'sometimes|nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ];
        }
        return [
            'ip_name' => 'required|string|max:50|min:2',
            'profiler_info_id' => ['required', 'int', new ProfilerInfoIDRule(),],
            'ip_description' => 'nullable|required|string|max:300|min:5',
            'ip_img' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ];
    }
}
