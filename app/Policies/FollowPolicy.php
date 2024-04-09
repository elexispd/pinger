<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Services\FollowService;

class FollowPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    protected $followService;

    public function __construct(FollowService $followService)
    {
        $this->followService = $followService;
    }
    // public function follow(User $user) {
    //     // Check if the request URL contains a username parameter
    //     if (strpos(Route::current()->uri(), '{username}') !== false) {
    //         // Get the username parameter value from the URL
    //         $username = request()->segment(2); // Assuming username is the second segment

    //         $follow = Follow::where('follower_id', $user->id)->orWhere('followed_id', $username)->first();
    //         if ($user->username === $username) {
    //             return false;
    //         }
    //         if ($follow) {
    //             return false;
    //         } else {
    //             return true;
    //         }
    //     } else {
    //         return false;
    //     }
    // }
    public function follow(User $user) {
        // Check if the request URL contains a username parameter
        if (strpos(Route::current()->uri(), '{username}') !== false) {
            // Get the username parameter value from the URL
            $username = request()->segment(2); // Assuming username is the second segment

            if ($user->username === $username) {
                return false; // User is trying to follow themselves
            }

            // Check if the current user is following the user
            $isFollowing = $this->followService->getFollow($username);

            // dd($isFollowing);

            if(!$isFollowing) {
                return true;
            } else{
                return false;
            }
        } else {
            return false;
        }
    }







}
