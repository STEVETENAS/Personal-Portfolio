<?php

namespace App\Http\Requests;

use App\Rules\ProfilerInfoIdRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProfilerExp extends FormRequest
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
            'job_title' => 'required|string|max:50|min:2',
            'company_name' => 'required|string|max:50|min:2',
            'company_website' => 'string|max:200|min:2',
            'job_start_date' => 'required',
            'job_end_date' => 'after:job_start_date',
            'profiler_infos_id' => ['required', 'int', new ProfilerInfoIDRule(),],
            'job_description' => 'string|max:300|min:5',
        ];
    }
}
