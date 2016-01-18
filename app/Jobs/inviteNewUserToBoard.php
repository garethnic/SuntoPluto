<?php

namespace Flisk\Jobs;

use Flisk\Invite;
use Flisk\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class inviteNewUserToBoard extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $invite;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Invite $invite)
    {
        $this->invite = $invite;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $invite = $this->invite;

        Mail::send('auth.emails.invite_member', ['member' => $this->invite], function ($m) use ($invite) {
            $m->from('info@suntopluto.com', 'SuntoPluto');

            $m->to($invite->new_member)->subject("Invitation to join a board on SuntoPluto");
        });
    }
}
