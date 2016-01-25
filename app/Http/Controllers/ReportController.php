<?php

namespace Flisk\Http\Controllers;

use Flisk\Board;
use Flisk\Task;
use Flisk\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Flisk\Http\Requests;
use Flisk\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class ReportController extends Controller
{
    /**
     * @param $identifier
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index($identifier)
    {
        $board = Board::where('identifier', $identifier)->first();

        if (Gate::allows('isOwner', $board)) {
            return view('reports.index', compact('board'));
        } else {
            return redirect('/boards');
        }
    }

    /**
     * Show all tasks
     *
     * @param $identifier
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function allTasks($identifier)
    {
        $user = auth()->user();

        $board = Board::where('identifier', $identifier)->first();

        $tasks = Task::where('board_identifier', $identifier)->withTrashed()
                                                             ->orderBy('created_at', 'desc')
                                                             ->paginate(10);

        foreach ($tasks as $task) {
            if (! is_null($task->assigned_user)) {
                $user = User::find($task->assigned_user);
                $task->assignee = $user->first_name . ' ' . $user->last_name;
            }
            if (! is_null($task->completed_by)) {
                $user = User::find($task->completed_by);
                $task->completedBy = $user->first_name . ' ' . $user->last_name;
            }
            $user = User::find($task->user_id);
            $task->createdBy = $user->first_name . ' ' . $user->last_name;
        }

        if (Gate::allows('isOwner', $board)) {
            return view('reports.all_tasks', compact('board', 'tasks', 'user'));
        } else {
            return redirect('/boards');
        }
    }

    /**
     * Show all completed tasks
     *
     * @param $identifier
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function completedTasks($identifier)
    {
        $user = auth()->user();

        $board = Board::where('identifier', $identifier)->first();

        $tasks = DB::table('tasks')->join('users', 'tasks.completed_by', '=', 'users.id')
                                   ->select('tasks.*', 'users.first_name', 'users.last_name')
                                   ->orderBy('tasks.completed_on', 'desc')
                                   ->paginate(10);

        foreach($tasks as $task) {
            $user = User::find($task->user_id);
            $task->createdBy = $user->first_name . ' ' . $user->last_name;
        }

        if (Gate::allows('isOwner', $board)) {
            return view('reports.completed_tasks', compact('board', 'tasks', 'user'));
        } else {
            return redirect('/boards');
        }
    }

    /**
     * Show deleted tasks
     *
     * @param $identifier
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function deletedTasks($identifier)
    {
        $user = auth()->user();

        $board = Board::where('identifier', $identifier)->first();

        $tasks = Task::where('board_identifier', $identifier)->onlyTrashed()
                                                             ->orderBy('deleted_at', 'desc')
                                                             ->paginate(10);

        foreach($tasks as $task) {
            $user = User::find($task->user_id);
            $task->createdBy = $user->first_name . ' ' . $user->last_name;
        }

        if (Gate::allows('isOwner', $board)) {
            return view('reports.deleted_tasks', compact('board', 'tasks', 'user'));
        } else {
            return redirect('/boards');
        }
    }
}
