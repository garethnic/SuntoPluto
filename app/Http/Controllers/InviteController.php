<?php

namespace Flisk\Http\Controllers;

use Flisk\Invite;
use Flisk\Board;
use Illuminate\Http\Request;
use Flisk\Http\Requests;
use Flisk\Http\Controllers\Controller;

class InviteController extends Controller
{
    /**
     * Show invites index page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index()
    {
        $user = auth()->user();

        $invites = Invite::where('new_member', $user->email)->get();

        foreach($invites as $invite) {
            $invite['board'] = Board::where('identifier', $invite->board_identifier)->first();
        }

        if (count($invites) < 1) {
            return redirect('/boards');
        }

        return view('invites.index', compact('invites'));
    }

    /**
     * Accept an invite to join a board
     *
     * @param $board
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function acceptInvite($board)
    {
        $user = auth()->user();
        $board = Board::where('identifier', $board)->first();

        $board->users()->attach($user);

        Invite::where('board_identifier', $board->identifier)->where('new_member', $user->email)->delete();

        return redirect('/boards');
    }

    /**
     * Decline an invite to join a board
     *
     * @param $board
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function declineInvite($board)
    {
        $user = auth()->user();
        $board = Board::where('identifier', $board)->first();

        $decline = Invite::where('board_identifier', $board->identifier)->where('new_member', $user->email)->delete();

        return redirect('/boards');
    }
}
