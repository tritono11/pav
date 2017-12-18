<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        \Laravel\Passport\Passport::routes();
        
        // Durata token prima del refresh
        \Laravel\Passport\Passport::tokensExpireIn( \Carbon::now()->addDays( config('api.tokensexpirein') ) );

        // Durata del token aggiornato
        \Laravel\Passport\Passport::refreshTokensExpireIn( \Carbon::now()->addDays(config('api.refreshtokensexpirein')));
    }
}
