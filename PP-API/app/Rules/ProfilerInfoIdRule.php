<?php

namespace App\Rules;

use App\Models\ProfilerInfo;
use Illuminate\Contracts\Validation\Rule;

class ProfilerInfoIdRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return ProfilerInfo::query()->where('id', $value)->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'Unrecognized Profiler Id';
    }
}
