<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function users()
    {
        $users = User::orderBy('id', 'DESC')->get();
        return view('admin.users', [
            'users' => $users
        ]);
    }

    public function delete($id)
    {
        $user = User::where('id', $id)->firstOrFail();
        $user->delete();
        return back()->with('msg', 'User Deleted');
    }

    public function edit_page($id)
    {
        $user = User::where('id', $id)->firstOrFail();
        return view('admin.user_edit', [
            'user' => $user
        ]);
    }

    public function save(Request $request, $id)
    {
        $request->validate([
            'name' => ['required'],

        ]);
        if ($request->password) {
            $request->merge(['password' => bcrypt($request->password)]);
            User::where('id', $id)->update($request->except(['_token']));
        } else {
            User::where('id', $id)->update($request->except(['_token', 'password']));
        }
        return back()->with('msg', 'User Saved');
    }
}
