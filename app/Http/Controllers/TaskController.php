<?php

namespace Flisk\Http\Controllers;

use Flisk\Board;
use Flisk\User;
use Flisk\Task;
use Illuminate\Http\Request;
use Flisk\Http\Requests;
use Flisk\Http\Controllers\Controller;

class TaskController extends Controller
{
    /**
     * Get all tasks in json
     * Used in vue - /tasks/all_json
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function getTasksJson(Request $request)
    {
        $tasks = Task::where('board_identifier', $request->board)->whereDone(0)->orderBy('created_at', 'desc')->get();
        $board = Board::where('identifier', $request->board)->first();

        $userCount = $board->users()->get()->count();

        if (is_null($tasks)) {
            return redirect('/boards');
        }

        foreach($tasks as $task) {
            if (!is_null($task->assigned_user)) {
                $task->assignee = User::where('id', $task->assigned_user)->first();
            }
            $task->user_count = $userCount;
        }

        return response()->json($tasks, 200);
    }

    /**
     * Add a new task
     * Used in vue - /tasks/add-task
     *
     * @param Request $request
     */
    public function addTask(Request $request)
    {
        $user = auth()->user();

        $user->tasks()->create([
            'content' => $request->task,
            'board_identifier' => $request->board
        ]);

        return response()->json('Task created', 200);
    }

    /**
     * Assign a task to a member
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function assignTask(Request $request)
    {
        $userId = (int) $request->user;
        $taskId = (int) $request->task;

        $user = User::find($userId);
        $task = Task::where('id', $taskId)->update(['assigned_user' => $userId]);

        return response()->json('Task assigned', 200);
    }

    /**
     * Remove a task
     * Used in vue - /tasks/remove-task
     *
     * @param Request $request
     */
    public function removeTask(Request $request)
    {
        $user = auth()->user();

        $user->tasks()->whereId($request->task)->first()->delete();

        return response()->json('Task removed', 200);
    }

    /**
     * Complete a task
     * Used in vue - /tasks/complete-task
     *
     * @param Request $request
     */
    public function completeTask(Request $request)
    {
        $user = auth()->user();

        Task::where('id', $request->task)->where('board_identifier', $request->board)
                                  ->first()
                                  ->update(['done' => true, 'completed_by' => $user->id]);

        return response()->json('Task completed', 200);
    }
}
