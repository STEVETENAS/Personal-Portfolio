<?php

namespace App\Http\Requests;

use App\Rules\ProfilerInfoIdRule;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class ProfilerEmailRequest extends FormRequest
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
    #[ArrayShape(['profiler_email' => "string[]", 'profiler_info_id' => "array", 'email_description' => "string[]"])]
    public function rules(): array
    {
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            return [
                'profiler_email' => ['required', 'string', 'max:50', 'min:2', 'unique:profiler_emails', 'sometimes'],
                'profiler_info_id' => ['required', 'int', new ProfilerInfoIDRule(), 'sometimes'],
                'email_description' => ['required', 'string', 'max:300', 'min:5', 'sometimes'],
            ];
        }
        return [
            'profiler_email' => ['required', 'string', 'max:50', 'min:2', 'unique:profiler_emails',],
            'profiler_info_id' => ['required', 'int', new ProfilerInfoIDRule(),],
            'email_description' => ['required', 'string', 'max:300', 'min:5',],
        ];
    }
}
