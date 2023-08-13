<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\JawabanModel;
use App\Models\PackageModel;
use App\Models\QuestionsModel;
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
        $total_materi = count(PackageModel::where('user_id', Auth::user()->id)->get());
        $total_siswa = DB::table('siswa')->join('package', 'siswa.package_id', '=', 'package.slug')->join('users', 'users.id', '=', 'package.user_id')->where('users.id', '=', Auth::user()->id)->get();
        return view('user.dashboard', [
            'total_materi' => $total_materi,
            'total_siswa' => count($total_siswa)
        ]);
    }

    public function materi()
    {
        $package = PackageModel::where('user_id', '=', Auth::user()->id)->latest()->get();
        $collection = Collection::where('user_id', Auth::user()->id)->latest()->get();
        return view('user.materi', [
            'materi' => $package,
            'koleksi' => $collection
        ]);
    }

    public function tambah_materi()
    {
        return view('user.tambah_materi');
    }
    public function post_tambah_materi(Request $request)
    {
        $request->validate([
            'title' => 'required|max:150',
            'description' => 'required|max:1000',
            'timer' => 'required|integer|min:0'
        ], [
            'title.required' => 'judul tidak boleh kosong',
            'title.max' => 'judul tidak boleh lebih dari 150 karakter',
            'description.required' => 'Deskripsi tidak boleh kosong',
            'description.max' => 'Deskripsi tidak boleh lebih dari 1000 karakter',
            'timer.required' => 'Waktu pengerjaan tidak boleh kosong',
            'timer.integer' => 'Waktu pengerjaan harus berupa bilangan bulat positif',
            'timer.min' => 'Waktu pengerjaan minimal 1 menit'
        ]);

        $slug = Str::random(4) . '-' . Str::random(3) . '-' . Str::random(3);

        $request->mergeIfMissing(['slug' => $slug]);
        $request->mergeIfMissing(['user_id' => Auth::user()->id]);
        $request->merge(['timer' => (int)$request->timer * 60]);
        PackageModel::create($request->except(['_token']));

        return redirect('/dashboard/topik')->with('msg', 'Topik berhasil ditambahkan');
    }

    public function materi_hapus($slug)
    {
        PackageModel::where('user_id', '=', Auth::user()->id)->where('slug', '=', $slug)->firstOrFail();
        $img = QuestionsModel::where('user_id', '=', Auth::user()->id)->where('package_slug', '=', $slug)->get();
        if ($img) {
            foreach ($img as $path) {
                if ($path->image_path != null) {
                    Storage::disk('public')->delete($path->image_path);
                }
            }
        }
        JawabanModel::where('package_id', $slug)->delete();
        SiswaModel::where('package_id', $slug)->delete();
        QuestionsModel::where('user_id', Auth::user()->id)->where('package_slug', $slug)->delete();

        PackageModel::where('user_id', '=', Auth::user()->id)->where('slug', '=', $slug)->delete();
        return redirect('/dashboard/topik')->with('msg', 'Topik berhasil dihapus');
    }

    public function materi_package($slug)
    {
        $package = PackageModel::where('user_id', '=', Auth::user()->id)->where('slug', '=', $slug)->firstOrFail();
        $data = QuestionsModel::where('user_id', '=', Auth::user()->id)->where('package_slug', '=', $slug)->orderBy('order_id', 'ASC')->get();
        // dd($package->get_slides());
        return view('user.materi_package', [
            'package' => $package,
            'data' => $data
        ]);
    }

    public function input_materi_package($slug)
    {
        $package = PackageModel::where('user_id', '=', Auth::user()->id)->where('slug', '=', $slug)->firstOrFail();
        return view('user.input_materi_package', [
            'materi' => $package
        ]);
    }

    public function post_input_materi_package($slug, Request $request)
    {
        $request->validate([
            'content' => 'required',
            'title' => 'required|max:150',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'content.required' => 'Konten wajib diisi',
            'title.required' => 'Judul wajib diisi',
            'title.max' => 'Maksimal judul 150 karakter'
        ]);
        $image_path = null;
        if ($request->file('image')) {
            $image_path = $request->file('image')->store('storage/user/img');
        }
        if ($request->type == 'pilihan_ganda') {
            $request->merge(['correct_answer' => $request->correct_answer_pilihan_ganda]);
        } else if ($request->type == 'isian') {
            $request->merge(['correct_answer' => $request->correct_answer_isian]);
        }
        $data = QuestionsModel::where('user_id', '=', Auth::user()->id)->where('package_slug', '=', $slug)->get();
        $order_id = count($data) + 1;
        $request->merge([
            'user_id' => Auth::user()->id,
            'package_slug' => $slug,
            'order_id' => (string)$order_id,
            'image_path' => $image_path,
            'correct_answer' => $request->correct_answer,
        ]);
        QuestionsModel::create($request->except(['_token', 'correct_answer_pilihan_ganda', 'correct_answer_isian', 'image']));
        return redirect('/dashboard/topik/' . $slug)->with('msg', 'Slide berhasil ditambahkan');
    }

    public function slide_hapus($slug, $id)
    {
        $img = QuestionsModel::where('user_id', '=', Auth::user()->id)->where('id', '=', $id)->firstOrFail();
        if ($img->image_path != null) {
            Storage::disk('public')->delete($img->image_path);
        }
        QuestionsModel::where('user_id', '=', Auth::user()->id)->where('id', '=', $id)->delete();
        return redirect('/dashboard/topik/' . $slug)->with('msg', 'Slide berhasil dihapus');
    }


    public function materi_edit($slug)
    {
        $data = PackageModel::where('user_id', '=', Auth::user()->id)->where('slug', '=', $slug)->firstOrFail();


        return view('user.edit_materi', [
            'materi' => $data
        ]);
    }

    public function post_materi_edit($slug, Request $request)
    {
        $request->validate([
            'title' => 'required|max:150',
            'description' => 'required|max:1000',
            'timer' => 'required|integer|min:0'
        ], [
            'title.required' => 'judul tidak boleh kosong',
            'title.max' => 'judul tidak boleh lebih dari 150 karakter',
            'description.required' => 'Deskripsi tidak boleh kosong',
            'description.max' => 'Deskripsi tidak boleh lebih dari 1000 karakter',
            'timer.required' => 'Waktu pengerjaan tidak boleh kosong',
            'timer.integer' => 'Waktu pengerjaan harus berupa bilangan bulat positif',
            'timer.min' => 'Waktu pengerjaan minimal 1 menit'
        ]);
        $request->merge(['timer' => (int)$request->timer * 60]);
        PackageModel::where('user_id', '=', Auth::user()->id)->where('slug', '=', $slug)->update($request->except(['_token', 'topic_type']));

        return redirect('/dashboard/topik/')->with('msg', 'Topik berhasil diperbarui');
    }

    public function list_hasil()
    {
        $package = PackageModel::with('get_students')->where('user_id', Auth::user()->id)->latest()->get();
        return view('user.hasil', [
            'package' => $package
        ]);
    }

    public function hasil_materi($slug)
    {
        $data = DB::table('siswa')->join('package', 'siswa.package_id', '=', 'package.slug')->where('package.user_id', '=', Auth::user()->id)->where('package.slug', '=', $slug)->latest('siswa.created_at')->select('siswa.id', 'siswa.u_id', 'siswa.name', 'siswa.kelas', 'siswa.score', 'siswa.created_at', 'siswa.updated_at', 'siswa.time_left', 'siswa.package_id')->get();
        $package = PackageModel::where('slug', $slug)->where('user_id', Auth::user()->id)->firstOrFail();
        // dd($data);
        return view('user.hasil_materi', [
            'siswa' => $data,
            'package' => $package
        ]);
    }

    public function export($slug)
    {
        $package = PackageModel::where('slug', $slug)->firstOrFail();
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Smafy_data.xls");
        $siswa_data = SiswaModel::where('package_id', $slug)->get();
        $soal = QuestionsModel::where('package_slug', $slug)->where(function (Builder $query) {
            return $query->where('type', 'pilihan_ganda')->orWhere('type', 'isian');
        })->get();
        // dd($siswa_data[0]->get_answer);
        return view('templates.excel', [
            'siswa_data' => $siswa_data,
            'soal' => $soal,
            'package' => $package
        ]);
    }

    public function hasil_materi_detail($slug, $u_id)
    {
        $data = DB::table('jawaban')->join('package', 'jawaban.package_id', '=', 'package.slug')->join('questions', 'jawaban.soal_id', '=', 'questions.id')->where('package.user_id', '=', Auth::user()->id)->where('jawaban.package_id', '=', $slug)->where('jawaban.u_id', '=', $u_id)->get();
        $package = PackageModel::where('slug', $slug)->where('user_id', Auth::user()->id)->firstOrFail();
        $siswa = SiswaModel::where('u_id', $u_id)->firstOrFail();
        // dd($data);
        return view('user.hasil_materi_detail', [
            'data' => $data,
            'package' => $package,
            'siswa' => $siswa
        ]);
    }


    public static function hapus_jawaban($u_id)
    {
        SiswaModel::where('u_id', '=', $u_id)->delete();
        $data = DB::table('jawaban')->join('package', 'jawaban.package_id', '=', 'package.slug')->where('jawaban.u_id', '=', $u_id)->where('package.user_id', '=', Auth::user()->id)->delete();
        return back()->with('msg', 'Jawaban berhasil dihapus');
    }

    public static function slide_edit($slug, $id)
    {
        $data = QuestionsModel::where('user_id', Auth::user()->id)->where('package_slug', $slug)->where('id', $id)->firstOrFail();
        $materi = PackageModel::where('user_id', Auth::user()->id)->where('slug', $slug)->first();
        return view('user.edit_slide', [
            'data' => $data,
            'materi' => $materi
        ]);
    }

    public static function slide_edit_simpan($slug, $id, Request $request)
    {
        $request->validate([
            'content' => 'required',
            'title' => 'required|max:150',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'order_id' => 'required|numeric|min:0'
        ], [
            'content.required' => 'Konten wajib diisi',
            'title.required' => 'Judul wajib diisi',
            'title.max' => 'Maksimal judul 150 karakter'
        ]);
        $data = QuestionsModel::where('user_id', Auth::user()->id)->where('package_slug', $slug)->where('id', $id)->firstOrFail();
        $image_path = $data->image_path;
        if ($request->file('image')) {
            if ($data->image_path) {
                Storage::disk('public')->delete($data->image_path);
            }
            $image_path = $request->file('image')->store('storage/user/img');
        }

        $request->mergeIfMissing([
            'image_path' => $image_path,
        ]);
        if ($request->type == 'pilihan_ganda') {
            $request->mergeIfMissing([
                'correct_answer' => $request->correct_answer_pilihan_ganda
            ]);
        } else if ($request->type == 'isian') {
            $request->mergeIfMissing([
                'correct_answer' => $request->correct_answer_isian
            ]);
        }

        $update_data = QuestionsModel::where('user_id', Auth::user()->id)->where('package_slug', $slug)->where('id', $id);
        $update_data->update($request->except(['_token', 'correct_answer_pilihan_ganda', 'correct_answer_isian', 'image']));
        return redirect()->to('/dashboard/topik/' . $slug)->with('msg', 'Slide berhasil simpan');
    }
}
