<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LikeController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'like' => ['required'], // Assuming you're validating the 'like' field
        'idea_id' => ['required'],
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()->first()], 422);
    }

    $user_id = Auth::id();
    $idea_id = $request->input('idea_id');

    // Check if the like already exists for the user and idea
    $existingLike = Like::where('user_id', $user_id)
                        ->where('idea_id', $idea_id)
                        ->first();

    if ($existingLike) {
        // Delete the existing like
        $existingLike->delete();
        $action = 'deleted';
    } else {
        // Create a new like
        Like::create([
            'user_id' => $user_id,
            'idea_id' => $idea_id,
        ]);
        $action = 'created';
    }

    return response()->json(['success' => $action]);
}



    public function show(Like $like)
    {
        //
    }

    public function edit(Like $like)
    {
        //
    }


    public function update(Request $request, Like $like)
    {
        //
    }


    public function destroy(Like $like)
    {
        //
    }
}
