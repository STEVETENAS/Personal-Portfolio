<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class ProfilerProjectFactory extends Factory
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
            'project_title' => $this->faker->name,
            'project_link' => $this->faker->domainName,
            'project_description' => $this->faker->realText(300),
            'profiler_infos_id' => $this->faker->randomElement($profilerIDs),
            'started_on' => $this->faker->date,
            'finished_on' => $this->faker->date,
        ];
    }
}
