<?php

namespace App\Services;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Support\Facades\Auth;
use App\Services\UserService;

class FollowService
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function getUsersNotFollowed($limit = null) {
        if (!Auth::check()) {
            return []; // or any other appropriate action for unauthenticated users
        }
        $currentUser = Auth::user();
        $usersFollowedIds = $currentUser->following->pluck('id');
        $usersFollowingIds = $currentUser->followers->pluck('id');
        $excludedUserIds = $usersFollowedIds->merge($usersFollowingIds)->unique();

        // Query users who are not in the excluded list (neither following nor being followed)
        $query = User::whereNotIn('id', $excludedUserIds)
                        ->where('id', '!=', $currentUser->id)
                        ->inRandomOrder();

        if ($limit !== null) {
            $query->take($limit);
        }

        return $query->get();
    }

    public function getFollow($targetUser) {
        $currentUser = Auth::user();
        $targetUser =  $this->userService->getUser($targetUser);
        $isCurrentUserFollowingTarget = $currentUser->following->contains('id', $targetUser->id);
        // dd($isCurrentUserFollowingTarget);
        $isTargetUserFollowingCurrentUser = $targetUser->followers->contains('id', $currentUser->id);
        return $isCurrentUserFollowingTarget ;

    }


}
