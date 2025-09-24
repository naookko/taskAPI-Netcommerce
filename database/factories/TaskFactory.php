<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        $started_at = $this->faker->dateTimeBetween('-30 days', 'now');
        $expired_at = (rand(0,1) ? $this->faker->dateTimeBetween($started_at, '+30 days') : null);

        return [
            'name' => 'task 0',
            'description' => 'task content',
            'is_completed' => $this->faker->numberBetween(0, 1),
            'start_at' => $started_at,
            'expired_at' => $expired_at,
            'user_id' => User::factory(),
            'company_id' => Company::factory(),
        ];
    }
}
