<?php

namespace App\Services;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Support\Facades\Auth;

class FollowService
{
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

}
