<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\JawabanModel;
use App\Models\SiswaCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
    }

    public function hapus($collection_slug, $u_id)
    {
        $siswa = SiswaCollection::where('collection_slug', $collection_slug)->where('u_id', $u_id)->firstOrFail();
        $jawaban = JawabanModel::where('u_id', $u_id)->get();

        foreach ($jawaban as $j) {
            if ($j->get_soal->type == 'file_attachment') {
                Storage::disk('public')->delete([$j->answer]);
            }
        }
        JawabanModel::where('u_id', $u_id)->delete();
        $siswa->delete();
        return back()->with('msg', 'Jawaban berhasil dihapus');
    }
}
