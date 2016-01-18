<?php

namespace Flisk\Jobs;

use Flisk\User;
use Flisk\Jobs\Job;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendConfirmationEmail extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $user;

    /**
     * Create a new job instance.
     *
     * @param User $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @param Mailer $mailer
     * @return void
     */
    public function handle()
    {
        $user = $this->user;

        Mail::send('auth.emails.confirm_user_reg', ['user' => $this->user], function ($m) use ($user) {
            $m->from('info@suntopluto.com', 'SuntoPluto');

            $m->to($user->email, $user->first_name)->subject('Confirm Registration');
        });
    }
}
