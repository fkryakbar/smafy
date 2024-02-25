<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Sublesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SublessonController extends Controller
{
    public function index($slug)
    {
        $topic = Lesson::where('slug', $slug)->where('user_id', Auth::user()->id)->with('sublessons')->firstOrFail();
        // dd($topic);
        return view('user.sublessons.index', compact('topic'));
    }


    public function create(Request $request, $slug)
    {
        $request->validate([
            'title' => 'required|max:200',
            'sublesson_type' => 'required'
        ]);

        $request->mergeIfMissing([
            'slug' => Str::random(4) . '-' . Str::random(3) . '-' . Str::random(3),
            'user_id' => Auth::user()->id,
            'lesson_slug' => $slug,
            'timer' => 0
        ]);
        $topic = Lesson::where('slug', $slug)->where('user_id', Auth::user()->id)->firstOrFail();

        Sublesson::create($request->all());
        return back()->with('success', 'Subtopik berhasil dibuat');
    }

    public function delete($slug, $sublesson_slug)
    {
        Sublesson::where('slug', $sublesson_slug)->where('user_id', Auth::user()->id)->firstOrFail()->delete();
        return back()->with('success', 'Sub topik berhasil dihapus');
    }
}
