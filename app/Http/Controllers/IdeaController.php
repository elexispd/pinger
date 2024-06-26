<?php

namespace App\Http\Controllers;

use App\Mail\PingEmail;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Services\UserService;


class IdeaController extends Controller
{
    public function index()
    {
        //
    }

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    public function feed(Idea $idea)
{
    $idea_query = $idea->withCount(['comments', 'likes']) // Eager load comments and likes counts
                ->orderBy('created_at', 'desc'); // Order by creation date in descending order

    if (request()->has('search')) {
        $search = request()->get('search');
        $ideas = $idea_query->where('content', 'like', '%'.request()->get('search', '') . '%');
    }



    $ideas = $idea_query->paginate(5); // Execute the query and retrieve results


    return view('idea.index', compact('ideas'));
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


    public function myTimeline() {
        $user = Auth::user();
        $ideas = $user->ideas;
        $userByRoute = false;

        return view('idea.timeline', compact(['ideas', 'userByRoute']));
    }
    public function timeline(Request $request) {
        $user = $this->userService->getUser($request->username);
        $userByRoute = $this->userService ->getUserByRoute();
        $ideas = $user->ideas()->paginate(5);

        return view('idea.timeline', compact(['ideas', 'userByRoute']));
    }




    public function store(Request $request,)
    {
        $request->validate([
            'content' => ['required', 'max:500', 'min:10']
        ]);

        $is_saved = Idea::create([
            'content' => $request->input('content'),
            'user_id' => Auth::id()
        ]);

        $user = Auth::user();
        Mail::to($user->email)->send(new PingEmail($user));

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

        return view('idea.show', compact('idea'));

    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'idea_id' => 'required|int',
        ]);

        $content = $request->input('content');
        $ideaId = $request->input('idea_id');

        $idea = Idea::findOrFail($ideaId);
        $idea->content = $content;
        $idea->save();

        return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'Idea updated successfully.']);
    }


    public function destroy(Request $request)
    {
        $idea = Idea::findOrFail($request->input('delete_idea_id'));
        $idea->delete();
        return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'Idea deleted successfully.']);
    }




}
