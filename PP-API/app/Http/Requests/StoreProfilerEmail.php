<?php

namespace App\Http\Requests;

use App\Rules\ProfilerInfoIdRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProfilerEmail extends FormRequest
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
            'profiler_email' => 'required|string|max:50|min:2|unique:profiler_emails',
            'profiler_infos_id' => ['required', 'int', new ProfilerInfoIDRule(),],
            'email_description' => 'required|string|max:300|min:5',
        ];
    }
}
