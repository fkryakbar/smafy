<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\JawabanModel;
use App\Models\Lesson;
use App\Models\PackageModel;
use App\Models\QuestionsModel;
use App\Models\SiswaCollection;
use App\Models\SiswaModel;
use Facade\Ignition\Support\Packagist\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;

class DashboardController extends Controller
{
    public function index()
    {
        $topics = Lesson::where('user_id', Auth::user()->id)->get();

        $participants_total = 0;

        foreach ($topics as $topic) {
            $participants_total += count($topic->participants);
        }



        return view('user.dashboard.index', compact('topics', 'participants_total'));
    }
}
