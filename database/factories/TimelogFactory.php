<?php

namespace Database\Factories;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Timelog>
 */
class TimelogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $minutes = $this->faker->numberBetween(1, 24 * 60);

        $started = Carbon::parse($this->faker->dateTime());

        $stopped = $started->copy()->addMinutes($minutes);

        return [
            'employee_id' => Employee::factory()->create()->id,
            'minutes' => $minutes,
            'started_at' => $started,
            'stopped_at' => $stopped
        ];
    }
}
