<?php

namespace Flisk\Jobs;

use Flisk\Invite;
use Flisk\Jobs\Job;
use Flisk\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class inviteExistingUserToBoard extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $invite;
    protected $user;

    /**
     * Create a new job instance.
     *
     * @param Invite $invite
     * @param User $user
     * @return void
     */
    public function __construct(Invite $invite, User $user)
    {
        $this->invite = $invite;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $invite = $this->invite;
        $user = $this->user;

        Mail::send('invites.emails.invite_member', ['member' => $this->invite, 'user' => $this->user], function ($m) use ($invite) {
            $m->from('info@suntopluto.com', 'SuntoPluto');

            $m->to($invite->new_member)->subject("Invitation to join a board on SuntoPluto");
        });
    }
}
