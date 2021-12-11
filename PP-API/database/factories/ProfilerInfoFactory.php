<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProfilerInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $gender = $this->faker->randomElement(['male', 'female']);
        $profile_images = glob('public/storage/images/profile_images' . '/*.*');
        $bg_images = glob('public/storage/images/bg_images' . '/*.*');
        return [
            'first_name' => $this->faker->firstName($gender),
            'last_name' => $this->faker->lastName,
            'gender' => $gender,
            'place_of_birth' => $this->faker->city,
            'date_of_birth' => $this->faker->date,
            'profession' => $this->faker->jobTitle,
            'place_of_origin' => $this->faker->city,
            'number_of_children' => $this->faker->randomNumber(1),
            'married' => $this->faker->boolean,
            'profiler_image' => $this->faker->randomElement($profile_images),
            'background_image' => $this->faker->randomElement($bg_images),
        ];
    }
}
