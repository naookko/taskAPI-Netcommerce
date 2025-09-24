<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Psy\Util\Json;

class TaskController extends Controller
{
    public function create(TaskRequest $request) {
        $task = Task::create($request->validated());

        return response()->json([
            'id' => $task->id,
            'name' => $task->name,
            'description' => $task->description,
            'user' => $task->user->name,
            'company' => [
                'id' => $task->company->id,
                'name' => $task->company->name,
            ],
        ], 201);
    }
}
