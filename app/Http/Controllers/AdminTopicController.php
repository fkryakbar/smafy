<?php

namespace App\Http\Controllers;

use App\Models\JawabanModel;
use App\Models\PackageModel;
use App\Models\QuestionsModel;
use App\Models\SiswaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminTopicController extends Controller
{
    public function index()
    {
        $packages = PackageModel::orderBy('id', "DESC")->get();
        return view('admin.topic', [
            'packages' => $packages
        ]);
    }

    public function delete($slug)
    {
        PackageModel::where('slug', '=', $slug)->firstOrFail();
        $img = QuestionsModel::where('package_slug', '=', $slug)->get();
        if ($img) {
            foreach ($img as $path) {
                if ($path->image_path != null) {
                    Storage::disk('public')->delete($path->image_path);
                }
            }
        }
        JawabanModel::where('package_id', $slug)->delete();
        SiswaModel::where('package_id', $slug)->delete();
        QuestionsModel::where('package_slug', $slug)->delete();

        PackageModel::where('slug', '=', $slug)->delete();
        return redirect('admin/topic')->with('msg', 'Topic Deleted!');
    }

    public function edit_page($slug)
    {
        $package = PackageModel::where('slug', $slug)->firstOrFail();
        return view('admin.topic_edit', [
            'package' => $package
        ]);
    }

    public function save(Request $request, $slug)
    {
        PackageModel::where('slug', $slug)->firstOrFail();
        $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'timer' => 'required'
        ]);

        PackageModel::where('slug', $slug)->update($request->except(['_token']));
        return back()->with('msg', 'Topic Saved');
    }
}
