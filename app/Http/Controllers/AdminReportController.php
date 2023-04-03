<?php

namespace App\Http\Controllers;

use App\Models\ReportsModel;
use Illuminate\Http\Request;

class AdminReportController extends Controller
{
    public function index()
    {
        $reports = ReportsModel::orderBy('id', 'DESC')->get();
        return view('admin.report', [
            'reports' => $reports
        ]);
    }

    public function delete($id)
    {
        ReportsModel::where('id', $id)->firstOrFail()->delete();
        return back()->with('msg', 'Report deleted');
    }
}
