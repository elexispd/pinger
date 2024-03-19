<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idea;

class FeedController extends Controller
{

    public function index(Idea $idea)
    {
        $ideas = $idea->orderBy('created_at', 'desc')->get();

        return view('index', compact('ideas'));
    }
    public function timeline()
    {
        //
    }



}
