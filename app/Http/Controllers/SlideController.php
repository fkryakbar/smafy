<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{

    private function slideFormat($request)
    {
        if ($request->manual_correction_toggle == 1) {
            $request->merge([
                'manual_correction' => true
            ]);
        } else {
            $request->merge([
                'manual_correction' => false
            ]);
        }

        if ($request->type == 'penjelasan') {
            $request->merge([
                'format' => []
            ]);
        }
        if ($request->type == 'youtube_video') {
            $request->merge([
                'format' => [
                    'youtube_link' => $request->youtube_link
                ]
            ]);
        }
        if ($request->type == 'file_attachment') {
            $request->merge([
                'format' => [
                    'explanation' => $request->reasons,
                ]
            ]);
        }
        if ($request->type == 'short_answer') {
            $request->merge([
                'format' => [
                    'manual_correction' => $request->manual_correction,
                    'explanation' => $request->reasons,
                    'correct_answer' => $request->correct_answer_short_answer,
                ]
            ]);
        }
        if ($request->type == 'long_answer') {
            $request->merge([
                'format' => [
                    'manual_correction' => $request->manual_correction,
                    'explanation' => $request->reasons,
                    'correct_answer' => $request->correct_answer_long_answer,
                ]
            ]);
        }
        if ($request->type == 'multiple_choice') {
            $request->merge([
                'format' => [
                    'explanation' => $request->reasons,
                    'correct_answer' => $request->correct_answer_multiple_choice,
                    'choices' => [
                        'a' => $request->a,
                        'b' => $request->b,
                        'c' => $request->c,
                        'd' => $request->d,
                        'e' => $request->e,
                    ]
                ]
            ]);
        }

        return $request;
    }

    private $validationRules = [
        'title' => 'required|max:100',
        'type' => 'required',
        'image_path' => 'image|mimes:jpeg,png,jpg,gif|max:500',
        'content' => 'required',
    ];

    public function index($slug, $sublesson_slug)
    {
        $lesson = Lesson::where('slug', $slug)->where('user_id', Auth::user()->id)->with(['sublessons' => function ($query) use ($sublesson_slug) {
            $query->where('slug', $sublesson_slug);
        }])->firstOrFail();
        $slides = Slide::where('sublesson_slug', $sublesson_slug)->where('user_id', Auth::user()->id)->get();
        // dd($slides);
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
        $request->validate($this->validationRules);

        $lesson = Lesson::where('slug', $slug)->where('user_id', Auth::user()->id)->firstOrFail();

        $image_path = null;
        if ($request->file('image')) {
            $image_path = $request->file('image')->store('storage/user/img');
        }

        $request->merge([
            'user_id' => Auth::user()->id,
            'sublesson_slug' => $sublesson_slug,
            'image_path' => $image_path,
        ]);

        $request = $this->slideFormat($request);

        // dd($request->all());
        Slide::create($request->only(['title', 'type', 'image_path', 'content', 'user_id', 'sublesson_slug', 'format']));

        return redirect('/dashboard/lessons/' . $slug . '/' . $sublesson_slug)->with('success', 'Slide berhasil dibuat');
    }

    public function delete($slug, $sublesson_slug, $slide_id)
    {

        Slide::where('id', $slide_id)->where('user_id', Auth::user()->id)->firstOrFail()->delete();
        return back()->with('success', 'Slide berhasil dihapus');
    }

    public function edit($slug, $sublesson_slug, $slide_id)
    {
        $lesson = Lesson::where('slug', $slug)->where('user_id', Auth::user()->id)->with(['sublessons' => function ($query) use ($sublesson_slug) {
            $query->where('slug', $sublesson_slug);
        }])->firstOrFail();
        $slide = Slide::where('sublesson_slug', $sublesson_slug)->where('id', $slide_id)->where('user_id', Auth::user()->id)->firstOrFail();

        return view('user.slides.edit', compact('lesson', 'slide'));
    }

    public function update($slug, $sublesson_slug, $slide_id,  Request $request)
    {
        $request->validate($this->validationRules);


        $lesson = Lesson::where('slug', $slug)->where('user_id', Auth::user()->id)->with(['sublessons' => function ($query) use ($sublesson_slug) {
            $query->where('slug', $sublesson_slug);
        }])->firstOrFail();
        $slide = Slide::where('sublesson_slug', $sublesson_slug)->where('id', $slide_id)->where('user_id', Auth::user()->id)->firstOrFail();

        $image_path = $slide->image_path;

        if ($request->delete_image) {
            Storage::disk('public')->delete($slide->image_path);
            $image_path = null;
        }
        if ($request->file('image')) {
            if ($slide->image_path) {
                Storage::disk('public')->delete($slide->image_path);
            }
            $image_path = $request->file('image')->store('storage/user/img');
        }

        $request->merge([
            'image_path' => $image_path,
        ]);

        $request = $this->slideFormat($request);

        // dd($request->all());
        $slide->update($request->only(['title', 'type', 'image_path', 'content', 'user_id', 'sublesson_slug', 'format']));

        return redirect('/dashboard/lessons/' . $slug . '/' . $sublesson_slug)->with('success', 'Slide berhasil diperbarui');
    }
}
