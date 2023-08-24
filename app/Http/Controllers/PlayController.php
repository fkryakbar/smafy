<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\JawabanModel;
use App\Models\PackageModel;
use App\Models\QuestionsModel;
use App\Models\SiswaCollection;
use App\Models\SiswaModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class PlayController extends Controller
{
    public function index($slug)
    {
        // dd(session($slug));

        $collection = Collection::where('slug', $slug)->with(['packages' => function ($query) {
            $query->orderBy('created_at', 'asc');;
        }])->firstOrFail();

        if (session()->has($slug)) {
            if (SiswaCollection::where('u_id', session($slug)['u_id'])->first()) {
            } else {
                session()->forget([$slug]);
            }
        }
        if (session()->has($slug)) {
            $siswaCollection = SiswaCollection::where('u_id', session($slug)['u_id'])->where('collection_slug', $slug)->firstOrFail();
            foreach ($collection->packages as $key => $package) {
                if (!Arr::has(session($slug)['activities'], $package->slug)) {
                    $data =  session($slug)['activities'][$package->slug] = [
                        'score' => 0,
                        'package_id' => $package->slug,
                        'time_left' => 0,
                        'is_finished' => false,
                        'expired_time' => time() + $package->timer
                    ];
                    session([$slug . '.activities' . '.' . $package->slug => $data]);
                    $siswaCollection->update([
                        'activities' => session($slug)['activities']
                    ]);
                }
            }
            session([$slug . '.activities'  =>  $siswaCollection->activities]);
        }

        // dd(session($collection->slug));
        return view('play.register', [
            'collection' => $collection
        ]);
    }

    public function create_session(Request $request, $slug)
    {
        $request->validate([
            'name' => 'required|max:25',
            'kelas' => 'required|max:15'
        ], [
            'name.required' => 'Nama wajib diisi',
            'kelas.required' => 'Kelas wajib diisi',
            'name.max' => 'Maksimal nama adalah 25 huruf',
            'kelas.max' => 'Maksimal kelas adalah 15 huruf',
        ]);

        $u_id = Str::random(8);
        $collection = Collection::where('slug', $slug)->with('packages')->first();
        $activities = [];
        foreach ($collection->packages as $key => $package) {
            $activities[$package->slug] = [
                'score' => 0,
                'package_id' => $package->slug,
                'time_left' => 0,
                'is_finished' => false,
                'expired_time' => time() + $package->timer
            ];
        }

        $request->session()->put($slug, [
            'name' => $request->name,
            'kelas' => $request->kelas,
            'u_id' => $u_id,
            'collection_slug' => $slug,
            'activities' => $activities
        ]);
        SiswaCollection::create([
            'u_id' => $u_id,
            'collection_slug' => $slug,
            'name' => $request->name,
            'kelas' => $request->kelas,
            'activities' => $activities
        ]);
        return back();
    }


    public function play($collection_slug, $package_slug)
    {
        if (session()->has($collection_slug) && SiswaCollection::where('u_id', session($collection_slug)['u_id'])->first()) {
            $collection = Collection::where('slug', $collection_slug)->firstOrFail();
            $package = PackageModel::where('slug', '=', $package_slug)->firstOrFail();

            $soal = DB::table('questions')->where('package_slug', $package_slug)->leftJoin('jawaban', function ($join) use ($collection_slug) {
                $join->on('questions.id', '=', 'jawaban.soal_id')->where('jawaban.u_id', '=', session()->get($collection_slug)['u_id']);
            })->orderBy('order_id', 'asc')->get(['questions.id', 'user_id', 'package_slug', 'type', 'order_id', 'title', 'content', 'image_path', 'youtube_link', 'a', 'b', 'c', 'd', 'e', 'correct_answer', 'reasons', 'u_id', 'package_id', 'soal_id', 'answer', 'result']);

            $quiz = QuestionsModel::where('package_slug', '=', $package_slug)->Where(function ($query) {
                $query->where('type', '=', 'pilihan_ganda')->orWhere('type', '=', 'isian')->orWhere('type', '=', 'file_attachment');
            })->get();
            if ($package->topic_type == 'materi') {
                return view('play.materi', [
                    'package' => $package,
                    'soal' => $soal,
                    'quiz' => $quiz,
                    'collection' => $collection
                ]);
            }
            if ($package->topic_type == 'kuis') {
                return view('play.quiz', [
                    'package' => $package,
                    'soal' => $soal,
                    'quiz' => $quiz,
                    'collection' => $collection
                ]);
            }
        }

        return redirect()->to('/play/' . $collection_slug);
    }

    public function save($collection_slug, $package_slug)
    {
        if (session()->has($collection_slug)) {
            // dd(session($collection_slug));
            $result = JawabanModel::where('u_id', session($collection_slug)['u_id'])->where('package_id', $package_slug)->get();

            $benar = 0;
            $total = count(QuestionsModel::where('package_slug', $package_slug)->where(function (Builder $query) {
                return $query->where('type', 'pilihan_ganda')->orWhere('type', 'isian')->orWhere('type', 'file_attachment');
            })->get());
            foreach ($result as $value) {
                if ($value->result == 1) {
                    $benar = $benar + 1;
                }
            }
            $skor = 0;
            if ($total > 0) {
                $skor = round(($benar / $total) * 100, 2);
            }
            $time_left = 0;
            if ((int) session($collection_slug)['activities'][$package_slug]['expired_time'] - time() > 0) {
                $time_left = (int) session($collection_slug)['activities'][$package_slug]['expired_time'] - time();
            }
            $siswa = SiswaCollection::where('u_id', session($collection_slug)['u_id'])->first();
            $siswaActivities = $siswa->activities;
            $siswaActivities[$package_slug]['time_left'] = $time_left;
            $siswaActivities[$package_slug]['is_finished'] = true;
            $siswaActivities[$package_slug]['score'] = $skor;
            $siswa->activities = $siswaActivities;
            $siswa->save();

            session([$collection_slug . '.activities' => $siswa->activities]);

            return view('play.result', [
                'skor' => $siswa->activities[$package_slug]['score'],
                'total' => $total,
                'benar' => $benar,
                'package' => PackageModel::where('slug', $package_slug)->first(),
                'collection_slug' => $collection_slug
            ]);
        }
    }

    public function restart($collection_slug)
    {
        if (session()->has($collection_slug)) {
            $collection = Collection::where('slug', $collection_slug)->firstOrFail();
            if ($collection->allow_to_restart_activity == 1) {
                session([$collection_slug . '.u_id' => Str::random(8)]);
            }
        }

        return redirect('/play/' . $collection_slug);
    }

    public function submit_jawaban_api(Request $request, $collection_slug)
    {
        $item = $request->all();
        JawabanModel::create([
            'u_id' => session($collection_slug)['u_id'],
            'package_id' => $item['package_id'],
            'soal_id' => $item['soal_id'],
            'answer' => $item['user_answer'],
            'result' => $item['result']
        ]);
        $result = JawabanModel::where('u_id', session($collection_slug)['u_id'])->where('package_id', $item['package_id'])->get();
        if (count($result) > 0) {
            $benar = 0;
            $total_soal = count(QuestionsModel::where('package_slug', $item['package_id'])->where(function (Builder $query) {
                return $query->where('type', 'pilihan_ganda')->orWhere('type', 'isian')->orWhere('type', 'file_attachment');
            })->get());
            foreach ($result as $value) {
                if ($value->result == 1) {
                    $benar = $benar + 1;
                }
            }
            $skor = 0;
            if ($total_soal > 0) {
                $skor = round(($benar / $total_soal) * 100, 2);
            }
            $siswa = SiswaCollection::where('u_id', session($collection_slug)['u_id'])->first();
            $siswaActivities = $siswa->activities;
            $siswaActivities[$item['package_id']]['score'] = $skor;
            $siswa->activities = $siswaActivities;
            $siswa->save();
            return response([
                'message' => 'success'
            ]);
        }
    }


    public function submit_jawaban_file_api(Request $request, $collection_slug)
    {
        $request->validate([
            'user_answer' => 'mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
        ], [
            'user_answer.mimes' => 'File harus bertipe jpeg, png, jpg, dan pdf',
            'user_answer.max' => 'Ukuran file maksimal 2 MB'
        ]);

        $answer_path =  $request->file('user_answer')->store('/storage/user/upload');

        JawabanModel::create([
            'u_id' => session($collection_slug)['u_id'],
            'package_id' => $request->package_id,
            'soal_id' => $request->soal_id,
            'answer' => $answer_path,
            'result' => 1
        ]);
        $result = JawabanModel::where('u_id', session($collection_slug)['u_id'])->where('package_id', $request->package_id)->get();

        $benar = 0;
        $total_soal = count(QuestionsModel::where('package_slug', $request->package_id)->where(function (Builder $query) {
            return $query->where('type', 'pilihan_ganda')->orWhere('type', 'isian')->orWhere('type', 'file_attachment');
        })->get());
        foreach ($result as $value) {
            if ($value->result == 1) {
                $benar = $benar + 1;
            }
        }
        $skor = 0;
        if ($total_soal > 0) {
            $skor = round(($benar / $total_soal) * 100, 2);
        }
        $siswa = SiswaCollection::where('u_id', session($collection_slug)['u_id'])->first();
        $siswaActivities = $siswa->activities;
        $siswaActivities[$request->package_id]['score'] = $skor;
        $siswa->activities = $siswaActivities;
        $siswa->save();
        return response([
            'message' => 'success',
            'answer_path' => $answer_path
        ]);

        // return response($request->all());
    }

    public function submit_jawaban_kuis_api(Request $request, $collection_slug)
    {
        $item = $request->all();
        $user_answer = JawabanModel::where('u_id', session($collection_slug)['u_id'])->where('soal_id', $item['soal_id'])->where('package_id', $item['package_id'])->first();
        if ($user_answer) {
            $user_answer->update([
                'answer' => $item['user_answer'],
                'result' => $item['result']
            ]);
        } else {
            JawabanModel::create([
                'u_id' => session($collection_slug)['u_id'],
                'package_id' => $item['package_id'],
                'soal_id' => $item['soal_id'],
                'answer' => $item['user_answer'],
                'result' => $item['result']
            ]);
        }
        $result = JawabanModel::where('u_id', session($collection_slug)['u_id'])->where('package_id', $item['package_id'])->get();
        if (count($result) > 0) {
            $benar = 0;
            $total_soal = count(QuestionsModel::where('package_slug', $item['package_id'])->where(function (Builder $query) {
                return $query->where('type', 'pilihan_ganda')->orWhere('type', 'isian')->orWhere('type', 'file_attachment');
            })->get());
            foreach ($result as $value) {
                if ($value->result == 1) {
                    $benar = $benar + 1;
                }
            }
            $skor = 0;
            if ($total_soal > 0) {
                $skor = round(($benar / $total_soal) * 100, 2);
            }

            $siswa = SiswaCollection::where('u_id', session($collection_slug)['u_id'])->first();
            $siswaActivities = $siswa->activities;
            $siswaActivities[$item['package_id']]['score'] = $skor;
            $siswa->activities = $siswaActivities;
            $siswa->save();
            return response([
                'message' => 'success'
            ]);
        }
    }
    public function get_saved_answer_api($u_id, $package_slug)
    {
        $data = JawabanModel::where('u_id', $u_id)->where('package_id', $package_slug)->get();
        return response()->json(['body' => $data]);
    }
}
