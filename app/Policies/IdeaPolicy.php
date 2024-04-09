<?php

namespace App\Policies;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Route;

class IdeaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Idea $idea)
    {
        return $user->id === $idea->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user) {
        // Check if the request URL contains a username parameter
        if (strpos(Route::current()->uri(), '{username}') !== false) {
            // Get the username parameter value from the URL
            $username = request()->segment(2); // Assuming username is the second segment

            // Check if the username parameter matches the username of the current user
            if ($user->username === $username) {
                return true;
            }
        } else {
            // If the URL does not contain a username parameter, return true
            return true;
        }

        // If none of the conditions are met, deny access
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Idea $idea)
    {
        return $user->id === $idea->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Idea $idea)
    {
        return $user->id === $idea->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Idea $idea)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Idea $idea)
    {
        //
    }
}
