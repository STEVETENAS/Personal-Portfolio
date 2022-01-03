<?php

namespace App\Http\Requests;

use App\Rules\ProfilerInfoIdRule;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class ProfilerResidentRequest extends FormRequest
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
    #[ArrayShape(['place_of_residence' => "string", 'profiler_info_id' => "array", 'city_of_residence' => "string", 'country_of_residence' => "string", 'residence_longitude' => "string", 'residence_latitude' => "string"])]
    public function rules(): array
    {
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            return [
                'place_of_residence' => 'required|string|max:50|min:2|sometimes',
                'profiler_info_id' => ['required', 'int', new profilerInfoIDRule(), 'sometimes'],
                'city_of_residence' => 'required|string|max:50|min:2|sometimes',
                'country_of_residence' => 'required|string|max:50|min:2|sometimes',
                'residence_longitude' => 'required|numeric|sometimes',
                'residence_latitude' => 'required|numeric|sometimes',
            ];
        }

        return [
            'place_of_residence' => 'required|string|max:50|min:2',
            'profiler_info_id' => ['required', 'int', new profilerInfoIDRule(),],
            'city_of_residence' => 'required|string|max:50|min:2',
            'country_of_residence' => 'required|string|max:50|min:2',
            'residence_longitude' => 'required|numeric',
            'residence_latitude' => 'required|numeric',
        ];
    }
}
