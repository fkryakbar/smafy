<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\PackageModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CollectionController extends Controller
{
    public function index()
    {
        $topik = PackageModel::where('user_id', Auth::user()->id)->latest()->get();
        return view('user.koleksi.index', [
            'topik' => $topik
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:150',
            'description' => 'required|max:1000',
            'show_public' => 'required',
            'accept_responses' => 'required',
            'packages' => 'required'
        ]);
        $slug = Str::random(4) . '-' . Str::random(3) . '-' . Str::random(3);

        $request->merge([
            'user_id' => Auth::user()->id,
            'slug' => $slug
        ]);

        $collection = Collection::create($request->except(['packages']));

        $collection->packages()->attach($request->packages);

        return redirect('dashboard/topik')->with('msg', 'Koleksi Berhasil dibuat');
    }

    public function delete($slug)
    {
        $collection = Collection::where('slug', $slug)->where('user_id', Auth::user()->id)->firstOrFail();
        $collection->packages()->detach();
        $collection->delete();

        return redirect('/dashboard/topik')->with('msg', 'Koleksi Berhasil dihapus');
    }

    public function detail($slug)
    {
        $collection = Collection::where('slug', $slug)->where('user_id', Auth::user()->id)->firstOrFail();
        $topik = PackageModel::where('user_id', Auth::user()->id)->latest()->get();
        // dd($collection->packages);
        return view('user.koleksi.detail', [
            'collection' => $collection,
            'topik' => $topik
        ]);
    }

    public function update(Request $request,  $slug)
    {
        $request->validate([
            'title' => 'required|max:150',
            'description' => 'required|max:1000',
            'show_public' => 'required',
            'accept_responses' => 'required',
            'packages' => 'required'
        ]);
        $collection = Collection::where('slug', $slug)->where('user_id', Auth::user()->id)->firstOrFail();

        $collection->update($request->except(['packages']));

        $collection->packages()->sync($request->packages);

        return back()->with('msg', 'Koleksi berhasil diperbarui');
    }
}
