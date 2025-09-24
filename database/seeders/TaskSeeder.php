<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $companies = Company::all();

        Task::factory()
            ->count(5)
            ->sequence(fn ($sequence) => [
                'name' => 'task ' . ($sequence->index + 1),
                'user_id' => $users->random()->id,
                'company_id' => $companies->random()->id,
            ])
            ->create();
    }
}
