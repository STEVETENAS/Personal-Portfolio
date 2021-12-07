<?php

namespace App\Http\Requests;

use App\Rules\ProfilerInfoIdRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
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
            'name' => 'required|string|min:3|max:50|unique:users' . $this->user,
            'email' => 'required|string|min:8|max:50',
            'password' => 'required|string|min:8|max:50',
            'profiler_infos_id' => ['required|int', new ProfilerInfoIdRule()],
        ];
    }
}
