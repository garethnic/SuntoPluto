<?php

namespace Flisk\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'Flisk\Model' => 'Flisk\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        //Protect user/board views
        $gate->define('see', function ($user, $board) {
            return $user->boards()->where('identifier', $board->identifier)->first();
        });

        //Protect board owner views
        $gate->define('isOwner', function ($user, $board) {
            return $user->boards()->where('identifier', $board->identifier)
                                  ->where('owner', $user->id)
                                  ->first();
        });
    }
}
