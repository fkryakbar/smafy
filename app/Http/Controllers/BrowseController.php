<?php

namespace App\Http\Controllers;

use App\Models\PackageModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BrowseController extends Controller
{
    public function index(Request $request)
    {
        global $search;
        $search = $request->s;
        $packages = PackageModel::where('show_public', 1)->orderBy('id', 'DESC')->paginate(5);
        if ($request->s) {
            $packages = PackageModel::where('show_public', 1)->where(function (Builder $query) {
                global $search;
                return $query->where('title', 'LIKE', "%{$search}%")->orWhere('description', 'LIKE', "%{$search}%")->orWhere('topic_type', 'LIKE', "%{$search}%");
            })->orderBy('id', 'DESC')->paginate(5);
        }
        return view('landingPage.browse', [
            'packages' => $packages
        ]);
    }
}
