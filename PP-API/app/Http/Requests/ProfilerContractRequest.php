<?php

namespace App\Http\Requests;

use App\Rules\ProfilerInfoIdRule;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class ProfilerContractRequest extends FormRequest
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
    #[ArrayShape(['contract_type' => "string[]", 'profiler_info_id' => "array", 'contract_description' => "string[]", 'started_on' => "string[]", 'finished_on' => "string[]"])]
    public function rules(): array
    {
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            return [
                'contract_type' => ['required', 'string', 'max:50', 'min:2', 'sometimes'],
                'profiler_info_id' => ['required', 'int', new ProfilerInfoIDRule(), 'sometimes'],
                'contract_description' => ['nullable', 'string', 'max:300', 'min:3', 'sometimes'],
                'started_on' => ['required', 'date', 'sometimes'],
                'finished_on' => ['required', 'date', 'after:started_on', 'sometimes'],
            ];
        }
        return [
            'contract_type' => ['required', 'string', 'max:50', 'min:2',],
            'profiler_info_id' => ['required', 'int', new ProfilerInfoIDRule(),],
            'contract_description' => ['nullable', 'string', 'max:300', 'min:3',],
            'started_on' => ['required', 'date',],
            'finished_on' => ['required', 'date', 'after:started_on',],
        ];
    }
}
