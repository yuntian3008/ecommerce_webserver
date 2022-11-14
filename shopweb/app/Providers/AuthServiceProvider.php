<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::tokensCan([
            'read-scopes' => 'Read all scopes',
            '*' => 'All permissons',

            'create-administrators' => 'Create administrators',
            'read-administrators' => 'Read administrators',
            'update-administrators' => 'Update administrators',
            'block-administrators' => 'Block administrators',

            'read-limitedly-user-info' => 'Read limitedly user information',
            'read-user-info' => 'Read user information',
            'block-users' => 'Block user',


            'create-products' => 'Create products',
            'read-products' => 'Read products',
            'update-products' => 'Update products',
            'delete-products' => 'Delete products',

            'create-categories' => 'Create categories',
            'read-categories' => 'Read categories',
            'update-categories' => 'Update categories',
            'delete-categories' => 'Delete categories',

            'read-orders' => 'Read orders',
            'read-order-items' => 'Read order items',
            'cancel-orders' => 'Cancel orders',
            'approve-orders' => 'Approve orders',
            'package-orders' => 'Package orders',
            'ship-orders' => 'Ship orders',
            'to-complete-orders' => 'To complete orders'
        ]);
        //
    }
}
