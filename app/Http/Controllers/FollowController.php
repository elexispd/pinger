<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follow;
use Illuminate\Support\Facades\Auth;


class FollowController extends Controller
{
    public function store(Request $request)
    {
        try {
            $this->createFollow($request->get('follow'));
            return response()->json(['success' => true]);
        } catch(\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    // Method for handling non-AJAX requests
    public function storeRedirect(Request $request)
    {
        try {
            $this->createFollow($request->get('follow'));
            return redirect()->back()->with('alert',['type' => 'success', 'message' => 'User followed successfully']);
        } catch(\Exception $e) {
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Failed to follow user: ' . $e->getMessage()]);
        }
    }

    // Private method for creating follow relationship
    private function createFollow($followedId)
    {
        Follow::create([
            'follower_id' =>  Auth::id(),
            'followed_id' => $followedId,
        ]);
    }


    public function explore() {
        return view('follow.explore');
    }

}
