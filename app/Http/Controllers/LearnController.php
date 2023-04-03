<?php

namespace App\Http\Controllers;

use App\Models\JawabanModel;
use App\Models\PackageModel;
use Illuminate\Support\Str;
use App\Models\QuestionsModel;
use App\Models\SiswaModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LearnController extends Controller
{
    public function index($code, Request $request)
    {
        global $coded;
        $coded = $code;
        if (empty(QuestionsModel::where('package_slug', '=', $code)->get()[0])) {
            abort(404);
        } else {
            if ($request->session()->has($code)) {
                $check_if_available = SiswaModel::where('u_id', $request->session()->get($code)['u_id'])->first();
                if ($check_if_available) {
                    if ($request->session()->get($code)['package_slug'] == $code) {
                        $package = PackageModel::where('slug', '=', $code)->firstOrFail();
                        $soal = DB::table('questions')->where('package_slug', $code)->leftJoin('jawaban', function ($join) {
                            global $coded;
                            $join->on('questions.id', '=', 'jawaban.soal_id')->where('jawaban.u_id', '=', session()->get($coded)['u_id']);
                        })->orderBy('order_id', 'asc')->get(['questions.id', 'user_id', 'package_slug', 'type', 'order_id', 'title', 'content', 'image_path', 'youtube_link', 'a', 'b', 'c', 'd', 'e', 'correct_answer', 'reasons', 'u_id', 'package_id', 'soal_id', 'answer', 'result']);

                        if ($package->topic_type == 'materi') {
                            return view('Learn.learn3', [
                                'package' => $package,
                                'soal' => $soal,
                                'quiz_total' => QuestionsModel::where('package_slug', '=', $code)->Where(function ($query) {
                                    $query->where('type', '=', 'pilihan_ganda')->orWhere('type', '=', 'isian');
                                })->get()
                            ]);
                        } else if ($package->topic_type == 'kuis') {
                            return view('Learn.quiz', [
                                'package' => $package,
                                'soal' => $soal,
                                'quiz_total' => QuestionsModel::where('package_slug', '=', $code)->Where(function ($query) {
                                    $query->where('type', '=', 'pilihan_ganda')->orWhere('type', '=', 'isian');
                                })->get()
                            ]);
                        }
                    } else {
                        return view('Learn.temp_login', [
                            'package' => PackageModel::where('slug', '=', $code)->firstOrFail(),
                        ]);
                    }
                } else {
                    return view('Learn.temp_login', [
                        'package' => PackageModel::where('slug', '=', $code)->firstOrFail(),
                    ]);
                }
            } else {
                return view('Learn.temp_login', [
                    'package' => PackageModel::where('slug', '=', $code)->firstOrFail(),
                ]);
            }
        }
    }


    public function get_soal($package_id)
    {
        return response()->json(QuestionsModel::where('package_id', '=', $package_id)->first());
    }


    public function create_session($code, Request $request)
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
        $time_left = 0;
        if (PackageModel::where('slug', $code)->firstOrFail()->timer > 0) {
            $time_left = PackageModel::where('slug', $code)->firstOrFail()->timer;
        }
        $u_id = Str::random(8);
        $request->session()->put($code, ['name' => $request->name, 'kelas' => $request->kelas, 'u_id' => $u_id, 'is_finished' => false, 'package_slug' => $code, 'expired_time' => time() + $time_left]);
        SiswaModel::create([
            'u_id' => $u_id,
            'name' => $request->name,
            'kelas' => $request->kelas,
            'score' => 0,
            'package_id' => $code,
            'time_left' => 0
        ]);
        return redirect('/learn/' . $code);
    }


    public function flush_session(Request $request)
    {
        // $request->session()->forget('siswa');


        return redirect('/')->with('msg', 'Jawaban kamu sudah disimpan!');
    }
    public function clear_session(Request $request)
    {
        $request->session()->flush();


        return redirect('/')->with('msg', 'Riwayat berhasil dihapus');
    }


    public function submit_jawaban(Request $request)
    {
        $item = $request->all();
        JawabanModel::create([
            'u_id' => $request->session()->get($item['package_id'])['u_id'],
            'package_id' => $item['package_id'],
            'soal_id' => $item['soal_id'],
            'answer' => $item['user_answer'],
            'result' => $item['result']
        ]);
        $result = JawabanModel::where('u_id', $request->session()->get($item['package_id'])['u_id'])->where('package_id', $item['package_id'])->get();
        if (count($result) > 0) {
            $benar = 0;
            $total_soal = count(QuestionsModel::where('package_slug', $item['package_id'])->where(function (Builder $query) {
                return $query->where('type', 'pilihan_ganda')->orWhere('type', 'isian');
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
            SiswaModel::where('u_id', $request->session()->get($item['package_id'])['u_id'])->first()->update(['score' => $skor]);
        }
    }

    public function show_result($code, Request $request)
    {
        if ($request->session()->has($code)) {
            $result = JawabanModel::where('u_id', $request->session()->get($code)['u_id'])->where('package_id', $code)->get();
            if (count($result) >= 0) {
                $benar = 0;
                $total = count(QuestionsModel::where('package_slug', $code)->where(function (Builder $query) {
                    return $query->where('type', 'pilihan_ganda')->orWhere('type', 'isian');
                })->get());
                foreach ($result as $value) {
                    if ($value->result == 1) {
                        $benar = $benar + 1;
                    }
                }
                $time_left = 0;
                if ((int) $request->session()->get($code)['expired_time'] - time() > 0) {
                    $time_left = (int) $request->session()->get($code)['expired_time'] - time();
                }
                $siswa = SiswaModel::where('u_id', $request->session()->get($code)['u_id'])->first();
                $siswa->update(['time_left' => $time_left]);
                $request->session()->put($code, ['name' => $request->session()->get($code)['name'], 'kelas' => $request->session()->get($code)['kelas'], 'package_slug' => $code, 'u_id' => $request->session()->get($code)['u_id'], 'expired_time' => $request->session()->get($code)['expired_time'], 'is_finished' => true]);
                return view('Learn.result', [
                    'skor' => $siswa->score,
                    'total' => $total,
                    'benar' => $benar,
                    'package' => PackageModel::where('slug', $code)->first()
                ]);
            }
            abort(404);
        } else {
            abort(404);
        }
    }

    public function get_saved($u_id)
    {
        $data = JawabanModel::where('u_id', $u_id)->get();
        return response()->json(['body' => $data]);
    }

    public function submit_jawaban_quiz(Request $request)
    {
        $item = $request->all();
        $user_answer = JawabanModel::where('u_id', $request->session()->get($item['package_id'])['u_id'])->where('soal_id', $item['soal_id'])->where('package_id', $item['package_id'])->first();
        if ($user_answer) {
            $user_answer->update([
                'answer' => $item['user_answer'],
                'result' => $item['result']
            ]);
        } else {
            JawabanModel::create([
                'u_id' => $request->session()->get($item['package_id'])['u_id'],
                'package_id' => $item['package_id'],
                'soal_id' => $item['soal_id'],
                'answer' => $item['user_answer'],
                'result' => $item['result']
            ]);
        }
        $result = JawabanModel::where('u_id', $request->session()->get($item['package_id'])['u_id'])->where('package_id', $item['package_id'])->get();
        if (count($result) > 0) {
            $benar = 0;
            $total_soal = count(QuestionsModel::where('package_slug', $item['package_id'])->where(function (Builder $query) {
                return $query->where('type', 'pilihan_ganda')->orWhere('type', 'isian');
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
            SiswaModel::where('u_id', $request->session()->get($item['package_id'])['u_id'])->first()->update(['score' => $skor]);
        }
    }
}
