<?php

namespace App\Http\Requests;

use App\Rules\ProfilerInfoIdRule;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class ProfilerExpRequest extends FormRequest
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
    #[ArrayShape(['job_title' => "string[]", 'company_name' => "string[]", 'company_website' => "string[]", 'job_start_date' => "string[]", 'job_end_date' => "string[]", 'profiler_info_id' => "array", 'job_description' => "string[]"])]
    public function rules(): array
    {
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            return [
                'job_title' => ['required', 'string', 'max:50', 'min:2', 'sometimes'],
                'company_name' => ['required', 'string', 'max:50', 'min:2', 'sometimes'],
                'company_website' => ['nullable','string', 'max:200', 'min:2', 'sometimes'],
                'job_start_date' => ['required', 'date', 'sometimes'],
                'job_end_date' => ['nullable', 'after:job_start_date', 'sometimes'],
                'profiler_info_id' => ['required', 'int', new ProfilerInfoIDRule(), 'sometimes'],
                'job_description' => ['nullable','string', 'max:300', 'min:5', 'sometimes'],
            ];
        }
        return [
            'job_title' => ['required', 'string', 'max:50', 'min:2',],
            'company_name' => ['required', 'string', 'max:50', 'min:2',],
            'company_website' => ['nullable','string', 'max:200', 'min:2',],
            'job_start_date' => ['required', 'date',],
            'job_end_date' => ['nullable', 'after:job_start_date',],
            'profiler_info_id' => ['required', 'int', new ProfilerInfoIDRule(),],
            'job_description' => ['nullable','string', 'max:300', 'min:5',],
        ];
    }
}
