<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Collection;
use App\Models\JawabanModel;
use App\Models\Lesson;
use App\Models\PackageModel;
use App\Models\Participant;
use App\Models\QuestionsModel;
use App\Models\SiswaCollection;
use App\Models\SiswaModel;
use App\Models\Slide;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class PlayController extends Controller
{
    public function index($slug)
    {
        $lesson = Lesson::where('slug', $slug)->with('sublessons')->firstOrFail();
        if (session($slug)) {
            if (!Participant::where('id', session($slug)['participant_id'])->first()) {
                session()->forget([$slug]);
            } else {
                $participant = Participant::where('id', session($slug)['participant_id'])->first();
                return view('play.dashboard', compact('lesson', 'participant'));
            }
        }
        return view('play.register', compact('lesson'));
    }

    public function create_session(Request $request, $slug)
    {
        Lesson::where('slug', $slug)->first();
        $request->validate([
            'name' => 'required|max:40',
            'kelas' => 'required|max:15'
        ], [
            'name.required' => 'Nama wajib diisi',
            'kelas.required' => 'Kelas wajib diisi',
            'name.max' => 'Maksimal nama adalah 40 huruf',
            'kelas.max' => 'Maksimal kelas adalah 15 huruf',
        ]);


        $participant =  Participant::create([
            'lesson_slug' => $slug,
            'name' => $request->name,
            'kelas' => $request->kelas,
            'score_total' => 0,
            'details' => [
                'start_time' => [],
                'finished_sublessons' => []
            ]
        ]);

        $request->session()->put($slug, [
            'name' => $participant->name,
            'kelas' => $participant->kelas,
            'participant_id' => $participant->id,
            'lesson_slug' => $slug,
            'finished_sublessons' => []
        ]);
        return back();
    }


    public function play($slug, $sublesson_slug)
    {
        if (session()->has($slug)) {
            $participant = Participant::where('id', session($slug)['participant_id'])->first();
            if ($participant) {
                // dd($participant->details);
                $lesson = Lesson::where('slug', $slug)->whereHas('sublessons', function ($query) use ($sublesson_slug) {
                    $query->where('slug', $sublesson_slug);
                })->with(['sublessons' => function ($query) use ($sublesson_slug) {
                    $query->where('slug', $sublesson_slug);
                }])->firstOrFail();

                $slides = Slide::where('sublesson_slug', $sublesson_slug)->with(['answers' => function ($query) use ($slug) {
                    $query->where('participants_id', session($slug)['participant_id']);
                }])->get();

                if (!isset(session($slug)['start_time'][$sublesson_slug])) {
                    $time = time();

                    session()->put($slug . '.start_time.' . $sublesson_slug, [
                        'time' => $time
                    ]);

                    $payload = $participant->details;
                    $payload['start_time'][$sublesson_slug]['time'] = $time;
                    $participant->update([
                        'details' => $payload
                    ]);
                }
                if ($lesson->sublessons[0]->sublesson_type == 'materi') {
                    return view('play.materi2', compact('lesson', 'slides'));
                }
                return view('play.quiz2', compact('lesson', 'slides'));
            }
            session()->forget($slug);
        }
        return redirect()->to('/play/' . $slug);
    }

    public function save($slug, $sublesson_slug)
    {
        $lesson = Lesson::where('slug', $slug)->with(['sublessons' => function ($query) use ($sublesson_slug) {
            $query->where('slug', $sublesson_slug);
        }])->firstOrFail();
        if (session()->has($slug)) {

            $participant = Participant::where('id', session($slug)['participant_id'])->firstOrFail();

            $result = $participant->sublesson_result($sublesson_slug);
            $trueAnswer = $result->trueAnswer;
            $questions = $result->questions;
            $score_total = $result->score_total;

            if (!isset(session($slug)['finished_sublessons'][$sublesson_slug])) {
                $payload = $participant->details;

                $payload['finished_sublessons'][$sublesson_slug]['score'] = $result->score_total;
                $participant->update([
                    'details' => $payload
                ]);

                session()->put($slug . '.finished_sublessons.' . $sublesson_slug, [
                    'score' => $result->score_total
                ]);
            }
            return view('play.result', compact('lesson', 'score_total', 'trueAnswer', 'questions'));
        }
        return redirect()->to('/play/' . $slug);
    }

    public function restart($slug)
    {
        if (session()->has($slug)) {
            session()->forget($slug);
        }

        return redirect('/play/' . $slug);
    }

    public function api_save_answer(Request $request)
    {
        $item = $request->all();

        $checkAnswer = Answer::where('participants_id', session($item['lesson_slug'])['participant_id'])->where('slide_id', $item['slide_id'])->first();
        if (!$checkAnswer) {
            $answer =  Answer::create([
                'participants_id' => session($item['lesson_slug'])['participant_id'],
                'lesson_slug' => $item['lesson_slug'],
                'lesson_slug' => $item['lesson_slug'],
                'sublesson_slug' => $item['sublesson_slug'],
                'slide_id' => $item['slide_id'],
                'answer' => $item['answer'],
                'result' => $item['result'],
            ]);

            return response($answer);
        }

        return response('sudah dijawab');
    }
    public function api_save_answer_kuis(Request $request)
    {
        $item = $request->all();

        $checkAnswer = Answer::where('participants_id', session($item['lesson_slug'])['participant_id'])->where('slide_id', $item['slide_id'])->first();
        if (!$checkAnswer) {
            $answer =  Answer::create([
                'participants_id' => session($item['lesson_slug'])['participant_id'],
                'lesson_slug' => $item['lesson_slug'],
                'lesson_slug' => $item['lesson_slug'],
                'sublesson_slug' => $item['sublesson_slug'],
                'slide_id' => $item['slide_id'],
                'answer' => $item['answer'],
                'result' => $item['result'],
            ]);

            return response($answer);
        }
        $checkAnswer->update([
            'participants_id' => session($item['lesson_slug'])['participant_id'],
            'lesson_slug' => $item['lesson_slug'],
            'lesson_slug' => $item['lesson_slug'],
            'sublesson_slug' => $item['sublesson_slug'],
            'slide_id' => $item['slide_id'],
            'answer' => $item['answer'],
            'result' => $item['result'],
        ]);

        return response($checkAnswer);
    }

    public function api_save_file(Request $request)
    {
        $request->validate([
            'file' => 'mimes:jpeg,png,jpg,gif,svg,pdf|max:6144',
        ], [
            'file.mimes' => 'File harus bertipe jpeg, png, jpg, dan pdf',
            'file.max' => 'Ukuran file maksimal 6 MB'
        ]);
        $item = $request->all();

        $checkAnswer = Answer::where('participants_id', session($item['lesson_slug'])['participant_id'])->where('slide_id', $item['slide_id'])->first();
        $answer_path =  $request->file('file')->store('/storage/user/upload');
        if (!$checkAnswer) {
            $answer =  Answer::create([
                'participants_id' => session($item['lesson_slug'])['participant_id'],
                'lesson_slug' => $item['lesson_slug'],
                'lesson_slug' => $item['lesson_slug'],
                'sublesson_slug' => $item['sublesson_slug'],
                'slide_id' => $item['slide_id'],
                'answer' => $answer_path,
                'result' => true,
            ]);

            return response($answer);
        }

        return response('sudah dijawab');
    }


    public function api_get_saved_answer($participant_id, $sublesson_slug)
    {
        $data = Answer::where('participants_id', $participant_id)->where('sublesson_slug', $sublesson_slug)->get(['slide_id', 'answer', 'lesson_slug', 'sublesson_slug']);
        return response($data);
    }
}
