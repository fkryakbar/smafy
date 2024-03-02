<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{
    public function index()
    {
        $topics = Lesson::where('user_id', Auth::user()->id)->orderBy('id', "DESC")->get();
        return view('user.result.index', compact('topics'));
    }
}
