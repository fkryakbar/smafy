<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PlayController extends Controller
{
    public function index($slug)
    {
        $collection = Collection::where('slug', $slug)->with(['packages' => function ($query) {
            $query->orderBy('created_at', 'asc');;
        }])->firstOrFail();

        // dd();

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
        $request->session()->put($slug, [
            'name' => $request->name,
            'kelas' => $request->kelas,
            'u_id' => $u_id,
            'collection_slug' => $slug,
            'packages' => $collection->packages,
            'activities' => []
        ]);

        return back();
    }
}
