<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function show($id)
    {
        try {
            $task = Task::findOrFail($id);
            return response()->json($task, 200);
        } catch (\Exception $e) {
            return response('Not OK', 404);
        }
    }

    public function auth(Request $request)
    {
        try {
            $tasks = Task::where('user_id', $request->user_id)->get();

            return response()->json($tasks);
        } catch (\Exception $e) {
            return response('Not ok', 500);
        }
    }

    public function store(TaskRequest $request)
    {
        try {
            $newTask = Task::make([
                'user_id' => $request->user_id,
                'title' => $request->title,
                'completed' => $request->completed
            ]);

            $newTask->save();

            return response()->json($newTask, 201);
        } catch (\Exception $e) {

            return response('Not ok', 500);
        }
    }

    public function update(Request $request, $task_id)
    {
        try {
            $task = Task::findOrFail($task_id);
            $task->completed = $request->completed;
            $task->save();

            return response($task, 200);
        } catch (\Exception $e) {
            return response('Not OK', 404);
        }
    }

    public function destroy($id)
    {
        try {
            $task = Task::findOrFail($id);
            $task->delete();
            return response('Deleted', 200);
        } catch (\Exception $e) {
            return response('Not OK', 404);
        }
    }
}
