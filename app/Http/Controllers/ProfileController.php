<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    // public function show() {
    //     return view('profile.show');
    // }

    public function show($username = null) {
        if ($username === null) {
            $username = Auth::user()->username;
        }

        $user = $this->userService->getUser($username);
        $following = $user->following;
        $followers = $user->followers;

        return view('profile.show', compact(['user', 'following', 'followers', 'username']) );
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(User $user, Request $request)
    {

        $request->validate([
            'first_name' => ['required', 'max:500', 'min:2'],
            'last_name' => ['required', 'max:500', 'min:2'],
            'email' => 'required|unique:users,email,' .$user->id,

        ]);

         $update =  $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,

            ]);

        if($update) {
            return redirect()->back()->with('alert',['type' => 'success', 'message' => 'profile updated successfully']);

        } else  {
            dd($user);
        }


    }

    public function changePassword(Request $request) {
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->back()->with('alert',['type' => 'success','message' => 'password changed successfully']);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
