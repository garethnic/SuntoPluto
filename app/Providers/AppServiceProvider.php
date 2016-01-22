<?php

namespace Flisk\Providers;

use Flisk\Board;
use Flisk\User;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Ramsey\Uuid\Uuid;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Queue::failing(function (JobFailed $event) {
           Log::error('Error with Queue');
        });

        User::creating(function ($user) {
            return $user->token = str_random(12);
        });

        Board::creating(function ($board) {
            try {
                $uuid = Uuid::uuid1()->toString();
                $board->identifier = $uuid;
            } catch (UnsatisfiedDependencyException $e) {
                Log::error('UUID creation error => ' . $e);
                return response()->json('Error creating board', 500);
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
