<?php

namespace Database\Factories;

use App\Enums\PaymentTypes;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'department_id' => Department::factory()->create()->id,
            'full_name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'job_title' => $this->faker->jobTitle,
            'payment_type' => $this->faker->randomElement(PaymentTypes::getValues()),
            'salary' => $this->faker->numberBetween(1000 * 100, 99999 * 100),
            'hourly_rate' => $this->faker->numberBetween(10 * 100, 1000 * 100)
        ];
    }
}
