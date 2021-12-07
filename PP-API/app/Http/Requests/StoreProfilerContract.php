<?php

namespace App\Http\Requests;

use App\Rules\ProfilerInfoIDRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProfilerContract extends FormRequest
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
            'contract_type' => 'required|string|max:50|min:2',
            'profiler_infos_id' => ['required', 'int', new ProfilerInfoIDRule(),],
            'contract_description' => 'required|string|max:300|min:5',
        ];
    }
}
