<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Lesson;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{
    public function index()
    {
        $topics = Lesson::where('user_id', Auth::user()->id)->orderBy('id', "DESC")->get();
        return view('user.result.index', compact('topics'));
    }


    public function detail($slug)
    {
        $topic =  Lesson::where('user_id', Auth::user()->id)->where('slug', $slug)->with('participants')->firstOrFail();

        return view('user.result.detail', compact('topic'));
    }

    public function answers($slug, $participant_id)
    {
        $topic =  Lesson::where('user_id', Auth::user()->id)->where('slug', $slug)->with('participants')->firstOrFail();
        $participant =  Participant::where('lesson_slug', $slug)->where('id', $participant_id)->with(['answers' => function ($query) {
            $query->with(['slide', 'sublesson']);
        }])->firstOrFail();
        $groupedAnswers = $participant->answers->groupBy('sublesson.title');
        // dd($participant->answers->groupBy('sublesson.title'));
        return view('user.result.answers', compact('topic', 'participant', 'groupedAnswers'));
    }

    public function change_answer(Request $request)
    {
        $request->validate([
            'answer_id' => 'required',
            'result' => 'required',
        ]);

        $answer = Answer::where('id', $request->answer_id)->firstOrFail();

        $response =  $answer->update([
            'result' => (bool) $request->result
        ]);

        return response($response);
    }

    public function delete($slug, $participant_id)
    {
        $participant = Participant::where('id', $participant_id)->firstOrFail();

        $participant->delete();

        return back()->with('success', 'Berhasil dihapus');
    }
}
