<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;


class IdeaController extends Controller
{
    public function index()
    {
        //
    }

    public function feed(Idea $idea)
    {
        $ideas = $idea->withCount(['comments', 'likes']) // Eager load comments and likes counts
                    ->orderBy('created_at', 'desc')    // Order by creation date in descending order
                    ->get();
        return view('index', compact('ideas'));
    }

    public function loadComments(Idea $idea)
    {
        $skip = request()->query('skip', 0);
        $comments = $idea->comments()->skip($skip)->take(3)->get();
        $hasMore = $idea->comments->count() > $skip + 3;

        return response()->json([
            'comments' => $comments,
            'hasMore' => $hasMore,
        ]);
    }

    public function create()
    {

    }



    public function store(Request $request)
    {
        $request->validate([
            'content' => ['required', 'max:500', 'min:10']
        ]);

        $is_saved = Idea::create([
            'content' => $request->input('content'),
            'user_id' => Auth::id()
        ]);

        if ($is_saved) {
            return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'Idea created successfully.']);
        } else {
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Failed to create idea.']);
        }

    }

    public function show($idea_id)
    {

    // Eager load the idea with its comments and likes
        $idea = Idea::with(['comments', 'likes'])->find($idea_id);

        if (!$idea) {
            abort(404); // Return a 404 error if the idea is not found
        }

        return view('show', compact('idea'));

    }


    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
