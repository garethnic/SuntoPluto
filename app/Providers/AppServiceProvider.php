<?php

namespace Flisk\Providers;

use Flisk\Board;
use Flisk\User;
use Illuminate\Support\Facades\Mail;
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
        User::creating(function ($user) {
            return $user->token = str_random(12);
        });

        User::created(function ($user) {
            Mail::send('auth.emails.confirm_user_reg', ['user' => $user], function ($m) use ($user) {
                $m->from('info@suntopluto.com', 'SuntoPluto');

                $m->to($user->email, $user->first_name)->subject('Confirm Registration');
            });
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
