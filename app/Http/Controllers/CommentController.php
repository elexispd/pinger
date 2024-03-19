<?php

namespace App\Http\Controllers;


use App\Models\Comment;
use App\Models\Idea;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;



class CommentController extends Controller
{

    public function index(Comment $comment)
    {
        $comments = $comment->orderBy('created_at', 'desc')->get();
        return $comments;
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'comment' => ['required', 'max:500'],
            'idea_id' => ['required'],
        ]);

        if ($validator->fails()) {
            // return response()->json(['errors' => $validator->errors()->first()], 422);
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => $validator->errors()->first()]);
        }

        $comment = Comment::create([
            'comment' => $request->input('comment'),
            'idea_id' => $request->input('idea_id'),
            'user_id' => Auth::id()
        ]);

        $likeDetails = [
            'id' => $comment->id,
            'comment' => $comment->comment,
            'user_id' => $comment->user->username,
            'created_at' => $comment->created_at,
        ];

        // return response()->json(['success' => $likeDetails]);
        return redirect()->back()->with('alert', ['type' => 'success', 'message' => "You commented on this"]);
    }


    public function show(Comment $comment)
    {

    }


    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
