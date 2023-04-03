<?php

namespace App\Http\Controllers;

use App\Models\PackageModel;
use App\Models\QuestionsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PreviewController extends Controller
{
    public function index($slug)
    {
        $package = PackageModel::where('slug', $slug)->where('show_public', 1)->where('is_duplicated', 0)->firstOrFail();
        return view('landingPage.preview', [
            'package' => $package
        ]);
    }

    public function copy($slug, Request $request)
    {
        $package = PackageModel::where('slug', $slug)->firstOrFail();
        $questions = QuestionsModel::where('package_slug', $slug)->get();
        if ($package->user_id == Auth::user()->id) {
            return redirect()->to('/dashboard/topik/' . $slug)->with('msg', 'Tidak bisa menyalin milik anda sendiri');
        } else {
            $new_slug = Str::random(4) . '-' . Str::random(3) . '-' . Str::random(3);
            $user_id = Auth::user()->id;
            $request->merge($package->toArray());
            $request->merge(['slug' => $new_slug]);
            $request->merge(['user_id' => $user_id]);
            $request->merge(['is_duplicated' => 1]);
            $request->merge(['show_public' => 0]);
            $new_package = $request->except(['id', 'created_at', 'updated_at']);

            $new_questions = $request->merge($questions->toArray());

            $new_questions = $request->except(array_merge(array_keys($new_package), ['id', 'created_at', 'updated_at']));
            foreach ($new_questions as $question) {
                unset($question['id'], $question['created_at'], $question['updated_at']);
                $question['user_id'] = $user_id;
                $question['package_slug'] = $new_slug;
                if ($question['image_path']) {
                    $path = explode('/', $question['image_path']);
                    $filename = end($path);
                    $filename_extension = explode('.', $filename)[1];
                    $new_file_path = 'storage/user/img/' . Str::random(40) . '.' . $filename_extension;
                    File::copy($question['image_path'], $new_file_path);
                    $question['image_path'] = $new_file_path;
                }
                QuestionsModel::create($question);
            }
            PackageModel::create($new_package);

            return redirect()->to('/dashboard/topik/' . $new_slug)->with('msg', 'Topik Berhasil disalin');
        }
    }
}
