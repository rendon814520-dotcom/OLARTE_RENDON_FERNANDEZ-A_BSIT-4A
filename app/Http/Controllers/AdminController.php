<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function users() {
        $users = User::all();
        return view('admin.index', compact('users'));
    }

    public function view($id) {
        $user = User::findOrfail($id);
        return view('admin.view', compact('user'));
    }

    public function edit($id) {
        $user = User::findOrfail($id);
        return view('admin.edit', compact('user'));
    }

    public function update(Request $request, $id) {
        $user = User::findOrfail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'role' => 'required|in:admin,user',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();

        return redirect()->route('admin.index')->with('success', 'User updated successfully');
    }

    public function delete($id) {
        $user = User::findOrfail($id);
        $user->delete();
        return redirect()->route('admin.index')->with('success', 'User deleted successfully');
    }
}
