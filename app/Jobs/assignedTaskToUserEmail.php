<?php

namespace Flisk\Jobs;

use Flisk\Jobs\Job;
use Flisk\Task;
use Flisk\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class assignedTaskToUserEmail extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $user;
    protected $task;

    /**
     * Create a new job instance.
     *
     * @param User $user
     * @param Task $task
     * @return void
     */
    public function __construct(User $user, Task $task)
    {
        $this->user = $user;
        $this->task = $task;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = $this->user;
        $task = $this->task;

        Mail::send('tasks.emails.assigned_task', ['user' => $user, 'task' => $task], function ($m) use ($user) {
            $m->from('info@suntopluto.com', 'SuntoPluto');

            $m->to($user->email)->subject("A task has been assigned to you on SuntoPluto");
        });
    }
}
