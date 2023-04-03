<?php

namespace App\Http\Controllers;

use App\Models\ReportsModel;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {

        return view('landingPage.about');
    }

    public function store(Request $request)
    {
        $request->validate([
            'reporter' => 'required',
            'email' => 'required',
            'type' => 'required',
            'description' => 'required'
        ]);

        ReportsModel::create($request->except(['_token']));
        return back()->with('msg', 'Thank you for submiting feedback!');
    }
}
