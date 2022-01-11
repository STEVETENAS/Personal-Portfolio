<?php

namespace App\Http\Requests;

use App\Rules\ProfilerInfoIdRule;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class ProfilerAcademicRequest extends FormRequest
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
    #[ArrayShape(['diploma_title' => "array", 'profiler_info_id' => "array", 'institution_attended' => "array", 'diploma_description' => "array", 'started_on' => "array", 'finished_on' => "array"])]
    public function rules(): array
    {
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            return [
                'diploma_title' => ['required', 'string', 'max:50', 'min:2', 'sometimes',],
                'profiler_info_id' => ['required', 'int', new ProfilerInfoIDRule(), 'sometimes'],
                'institution_attended' => ['required', 'string', 'max:50', 'min:2', 'sometimes'],
                'diploma_description' => ['nullable', 'string', 'max:300', 'min:5', 'sometimes'],
                'started_on' => ['required', 'date', 'sometimes'],
                'finished_on' => ['nullable', 'date', 'after:started_on', 'sometimes'],
            ];
        }

        return [
            'diploma_title' => ['required', 'string', 'max:50', 'min:2',],
            'profiler_info_id' => ['required', 'int', new ProfilerInfoIDRule(),],
            'institution_attended' => ['required', 'string', 'max:50', 'min:2',],
            'diploma_description' => ['nullable', 'string', 'max:300', 'min:5',],
            'started_on' => ['required', 'date',],
            'finished_on' => ['nullable', 'date', 'after:started_on',],
        ];
    }
}
