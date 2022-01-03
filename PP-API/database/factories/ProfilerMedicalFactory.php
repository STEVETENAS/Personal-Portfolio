<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class ProfilerMedicalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $profilerIDs = DB::table('profiler_infos')->pluck('id')->toArray();
        return [
            'medical_status' => $this->faker->name,
            'medical_description' => $this->faker->realText(300),
            'profiler_info_id' => $this->faker->randomElement($profilerIDs),
        ];
    }
}
