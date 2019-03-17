<?php

namespace App\Providers;

use App\ApiScopes;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Password;
use Laravel\Passport\Passport;

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

        Passport::routes();

        $availableScopes = array();
        ApiScopes::all()->map(function($item) use(&$availableScopes) {
            $availableScopes[$item->name] = $item->title;
        });

//        dd($availableScopes);

        Passport::tokensCan($availableScopes);
    }
}
