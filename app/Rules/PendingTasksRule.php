<?php

namespace App\Rules;

use App\Models\Task;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PendingTasksRule implements ValidationRule
{
    protected $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $pendingTasks = Task::where('user_id', $this->userId)->where('is_completed', 0)->count();

        if($pendingTasks >= 5){
            $fail("The user have ".$pendingTasks." pending tasks.");
        }
    }
}
