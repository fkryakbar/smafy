<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LessonController extends Controller
{
    public function index()
    {
        $topics = Lesson::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('user.lessons.index', compact('topics'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|max:200',
            'description' => 'required|max:400'
        ]);

        $request->mergeIfMissing([
            'slug' => Str::random(4) . '-' . Str::random(3) . '-' . Str::random(3),
            'user_id' => Auth::user()->id,
            'deadline_time' => 0

        ]);


        Lesson::create($request->all());

        return back()->with('success', 'Topik Berhasil dibuat.');
    }

    public function delete($slug)
    {
        Lesson::where('slug', $slug)->where('user_id', Auth::user()->id)->firstOrFail()->delete();

        return back()->with('success', 'Topik berhasil dihapus');
    }


    public function update(Request $request, $slug)
    {
        $request->validate([
            'title' => 'required|max:200',
            'description' => 'required|max:400',
        ]);

        if ($request->deadline_time) {
            $request->merge([
                'deadline_time' => strtotime($request->deadline_time_date . ' ' . $request->deadline_time_time)
            ]);
        } else {
            $request->merge([
                'deadline_time' => 0
            ]);
        }


        $request->merge([
            'allow_to_restart_lesson' => $request->input('allow_to_restart_lesson', 0),
            'show_correct_answer' => $request->input('show_correct_answer', 0),
            'show_final_score' => $request->input('show_final_score', 0),
            'accept_responses' => $request->input('accept_responses', 0),
        ]);
        $topic = Lesson::where('slug', $slug)->where('user_id', Auth::user()->id)->firstOrFail();

        $topic->update($request->except(['deadline_time_date', 'deadline_time_time']));
        return back()->with('success', 'Pengaturan berhasil disimpan');
    }
}
