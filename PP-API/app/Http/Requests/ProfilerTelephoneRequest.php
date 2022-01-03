<?php

namespace App\Http\Requests;

use App\Rules\ProfilerInfoIdRule;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class ProfilerTelephoneRequest extends FormRequest
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
    #[ArrayShape(['profiler_phone_number' => "string", 'profiler_info_id' => "array", 'phone_number_description' => "string"])]
    public function rules(): array
    {
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            return [
                'profiler_phone_number' => 'required|string|max:15|min:2|unique:profiler_telephones|sometimes',
                'profiler_info_id' => ['required', 'int', new profilerInfoIDRule(), 'sometimes'],
                'phone_number_description' => 'required|string|max:300|min:2|sometimes',
            ];
        }

        return [
            'profiler_phone_number' => 'required|string|max:15|min:2|unique:profiler_telephones',
            'profiler_info_id' => ['required', 'int', new profilerInfoIDRule(),],
            'phone_number_description' => 'required|string|max:300|min:2',
        ];
    }
}
