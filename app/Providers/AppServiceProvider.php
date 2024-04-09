<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Follow;
use App\Services\FollowService;
use App\Services\UserService;
use Illuminate\Pagination\Paginator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $limit = $view->getData()['limit'] ?? null;
            $usersNotFollowed = app(FollowService::class)->getUsersNotFollowed($limit);
            $view->with('usersNotFollowed', $usersNotFollowed);
        });

        Paginator::useBootstrapFive();

        // View::composer('*', function ($view) {
        //    $user = auth()->user();
        //    $view->with('user', $user);
        // });


        // View::composer('*', function ($view) {
        //     $userService = app(UserService::class);
        //     $user = $userService->getUserByRoute();
        //     $view->with('userByRoute', $user);
        // });


    }
}
