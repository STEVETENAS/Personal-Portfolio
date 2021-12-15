<?php

namespace App\Http\Requests;

use App\Rules\ProfilerInfoIdRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProfilerIp extends FormRequest
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
            'ip_name' => 'required|string|max:50|min:2',
            'profiler_infos_id' => ['required', 'int', new ProfilerInfoIDRule(),],
            'ip_description' => 'required|string|max:300|min:5',
            'ip_img' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ];
    }
}
