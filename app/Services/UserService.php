<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class UserService
{
    public function getUser($username) {
        $user = User::where('username', $username)->firstOrFail();
        return $user;
    }
    public function getUserByRoute() {

        if (strpos(Route::current()->uri(), '{username}') !== false) {
            $username = request()->segment(2);
            $user = User::where('username', $username)->firstOrFail();
            return $user;
        } else {
            return false;
        }

     }

}
