<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class ProfilerContractFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $profilerIDs = DB::table('profiler_infos')->pluck('id')->toArray();
        $contract_type = ['long-term', 'short-term'];
        return [
            'contract_type' => $this->faker->randomElement($contract_type),
            'contract_description' => $this->faker->realText(300),
            'profiler_info_id' => $this->faker->randomElement($profilerIDs),
            'started_on' => $this->faker->date,
            'finished_on' => $this->faker->date,
        ];
    }
}
