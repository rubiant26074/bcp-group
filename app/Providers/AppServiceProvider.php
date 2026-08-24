<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Gate;
use App\Models\MenuItem;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Implicitly grant Admin users all permissions for Filament Shield & Policies
        Gate::before(function ($user, $ability) {
            return $user->hasRole('super_admin') || $user->role === 'admin' || $user->email === 'admin@berkahcipta.co.id' ? true : null;
        });

        Gate::policy(
            \Spatie\Permission\Models\Role::class,
            \App\Policies\RolePolicy::class
        );

        View::composer('layouts.app', function ($view) {
            $menuItems = MenuItem::whereNull('parent_id')
                ->where('is_active', true)
                ->with(['children' => fn ($q) => $q->where('is_active', true)->orderBy('order')])
                ->orderBy('order')
                ->get();
            $view->with('navMenuItems', $menuItems);
        });
    }
}
