<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SlideController extends Controller
{
    public function index($slug, $sublesson_slug)
    {
        $lesson = Lesson::where('slug', $slug)->where('user_id', Auth::user()->id)->with(['sublessons' => function ($query) use ($sublesson_slug) {
            $query->where('slug', $sublesson_slug);
        }])->firstOrFail();
        $slides = Slide::where('sublesson_slug', $sublesson_slug)->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        // dd($lesson);
        return view('user.slides.index', compact('lesson', 'slides'));
    }

    public function insert($slug, $sublesson_slug)
    {
        $lesson = Lesson::where('slug', $slug)->where('user_id', Auth::user()->id)->with(['sublessons' => function ($query) use ($sublesson_slug) {
            $query->where('slug', $sublesson_slug);
        }])->firstOrFail();
        return view('user.slides.insert', compact('lesson'));
    }


    public function create($slug, $sublesson_slug,  Request $request)
    {
        $request->validate([
            'title' => 'required|max:100',
            'type' => 'required',
            'image_path' => 'image|mimes:jpeg,png,jpg,gif|max:500',
            'content' => 'required',
        ]);

        $lesson = Lesson::where('slug', $slug)->where('user_id', Auth::user()->id)->firstOrFail();

        $image_path = null;
        if ($request->file('image')) {
            $image_path = $request->file('image')->store('storage/user/img');
        }
        // dd($image_path);
        $request->merge([
            'user_id' => Auth::user()->id,
            'sublesson_slug' => $sublesson_slug,
            'format' => [
                'a' => 'a',
                'b' => 'a',
                'c' => 'a',
                'd' => 'a',

            ],
            'image_path' => $image_path
        ]);

        // dd($request->all());
        Slide::create($request->only(['title', 'type', 'image_path', 'content', 'user_id', 'sublesson_slug', 'format']));

        return redirect('/dashboard/lessons/' . $slug . '/' . $sublesson_slug)->with('success', 'Slide berhasil dibuat');
    }

    public function delete($slug, $sublesson_slug, $slide_id)
    {

        Slide::where('id', $slide_id)->where('user_id', Auth::user()->id)->firstOrFail()->delete();
        return back()->with('success', 'Slide berhasil dihapus');
    }
}
