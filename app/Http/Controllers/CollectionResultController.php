<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\SiswaCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollectionResultController extends Controller
{
    public function index($collection_slug)
    {
        $collection = Collection::where('slug', $collection_slug)->where('user_id', Auth::user()->id)->with('students')->firstOrFail();

        return view('user.result.index', [
            'collection' => $collection
        ]);
    }

    public function detail($collection_slug, $u_id)
    {
        $collection = Collection::where('slug', $collection_slug)->where('user_id', Auth::user()->id)->with(['students'])->firstOrFail();
        $siswa = SiswaCollection::where('collection_slug', $collection_slug)->where('u_id', $u_id)->with(['collection'])->firstOrFail();
        return view('user.result.detail', [
            'siswa' => $siswa,
            'collection' => $collection
        ]);
        dd($siswa->collection->packages[1]->answers);
    }
}
