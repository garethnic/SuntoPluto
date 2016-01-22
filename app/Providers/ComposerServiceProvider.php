<?php

namespace Flisk\Providers;

use Flisk\Invite;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('partials.navbar', function ($view) {
            $user = auth()->user();

            $invites = Invite::where('new_member', $user->email)->get();

            $view->with('invites', $invites);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
