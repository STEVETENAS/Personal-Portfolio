<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfilerInfoRequest extends FormRequest
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
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            return [
                'first_name' => 'required|string|max:50|min:2|sometimes',
                'last_name' => 'required|string|max:50|min:2|sometimes',
                'profession' => 'required|string|max:50|min:2|sometimes',
                'gender' => 'required|string|max:10|min:4|sometimes',
                'place_of_birth' => 'required|string|max:30|min:2|sometimes',
                'place_of_origin' => 'required|string|max:30|min:2|sometimes',
                'date_of_birth' => 'required|sometimes',
                'number_of_children' => 'required|int|sometimes',
                'married' => 'required|bool|sometimes',
                'profiler_image' => 'sometimes|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'background_image' => 'sometimes|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ];
        }

        return [
            'first_name' => 'required|string|max:50|min:2',
            'last_name' => 'required|string|max:50|min:2',
            'profession' => 'required|string|max:50|min:2',
            'gender' => 'required|string|max:10|min:4',
            'place_of_birth' => 'required|string|max:30|min:2',
            'place_of_origin' => 'required|string|max:30|min:2',
            'date_of_birth' => 'required',
            'number_of_children' => 'required|int',
            'married' => 'required|bool',
            'profiler_image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'background_image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ];
    }
}
