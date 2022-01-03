<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class UserRequest extends FormRequest
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
    #[ArrayShape(['name' => "string", 'email' => "string", 'password' => "string", 'profiler_info_id' => "array"])]
    public function rules(): array
    {
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            return [
                'name' => 'required|string|min:3|max:50|unique:users|sometimes',
                'email' => 'required|string|min:8|max:50|sometimes',
                'password' => 'required|string|min:8|max:50|sometimes',
            ];
        }

        return [
            'name' => 'required|string|min:3|max:50|unique:users',
            'email' => 'required|string|min:8|max:50',
            'password' => 'required|string|min:8|max:50',
        ];
    }
}
