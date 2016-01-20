<?php

namespace Flisk\Http\Controllers;

use Flisk\Board;
use Flisk\Invite;
use Flisk\Jobs\inviteExistingUserToBoard;
use Flisk\User;
use Flisk\Jobs\inviteNewUserToBoard;
use Illuminate\Http\Request;
use Flisk\Http\Requests;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Flisk\Http\Controllers\Controller;

class BoardController extends Controller
{
    /**
     * Show boards index page
     * Show invites
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = auth()->user();

        $boards = $user->boards()->get();

        $invites = Invite::where('new_member', $user->email)->get();

        return view('boards.index', compact('boards', 'invites'));
    }

    /**
     * Show a board's tasks
     *
     * @param $identifier
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function boardTasks($identifier)
    {
        $board = Board::where('identifier', $identifier)->first();

        if (Gate::denies('see', $board)) {
            return redirect('/boards');
        }

        if (is_null($board)) {
            return redirect('/boards');
        }

        return view('task_home', compact('board'));
    }

    /**
     * Show create board page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createBoard()
    {
        return view('boards.create');
    }

    /**
     * Post new board to the database
     *
     * @param Requests\CreateBoardRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postBoard(Requests\CreateBoardRequest $request)
    {
        $user = auth()->user();

        $board = Board::create(['name' => $request->name,]);

        $user->boards()->attach($board, ['owner' => $user->id]);

        return redirect('/boards');
    }

    /**
     * Add a new member to the board
     * Check if new user or existing user is invited
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addMemberToBoard(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return response()->json('Email is required and in the right format', 400);
        }

        $user = User::where('email', $request->email)->first();
        $board = Board::where('identifier', $request->board)->first();

        if (is_null($user)) {
            $member = Invite::create(['new_member' => $request->email, 'board_identifier' => $request->board]);

            //Queue invite email to new user
            $job = (new inviteNewUserToBoard($member))->delay(60 * 2);

            $this->dispatch($job);

            return response()->json('successfully invited new member', 200);
        } else {
            $member = Invite::create(['new_member' => $user->email, 'board_identifier' => $request->board]);

            //Queue invite to existing user
            $job = (new inviteExistingUserToBoard($member, $user))->delay(60 * 2);

            $this->dispatch($job);

            return response()->json('successfully invited new member', 200);
        }
    }

    /**
     * Get all board members as json
     * Used in vue - /members
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBoardMembers(Request $request)
    {
        $board = Board::where('identifier', $request->board)->first();

        $boardUsers = $board->users()->where('active', true)->get();

        return response()->json($boardUsers);
    }
}
