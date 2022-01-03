<?php

namespace App\Http\Requests;

use App\Rules\ProfilerInfoIdRule;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class ProfilerLangRequest extends FormRequest
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
    #[ArrayShape(['language' => "string", 'profiler_info_id' => "array", 'language_level' => "string"])]
    public function rules(): array
    {
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            return [
                'language' => 'required|string|max:50|min:2|sometimes',
                'profiler_info_id' => ['required', 'int', new ProfilerInfoIDRule(), 'sometimes'],
                'language_level' => 'required|int|max:10|min:1|sometimes',
            ];
        }
        return [
            'language' => 'required|string|max:50|min:2',
            'profiler_info_id' => ['required', 'int', new ProfilerInfoIDRule(),],
            'language_level' => 'required|int|max:10|min:1',
        ];
    }
}
