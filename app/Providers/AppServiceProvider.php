<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
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
        \Illuminate\Support\Facades\Gate::policy(
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
