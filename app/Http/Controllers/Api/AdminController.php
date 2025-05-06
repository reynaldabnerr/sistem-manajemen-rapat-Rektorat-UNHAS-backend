<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        // Fetch all users with the role of 'admin'
        // This assumes you have a 'role' column in your users table
        // and that it contains the value 'admin' for admin users.
        $admins = User::where('role', 'admin')->get();
        return response()->json($admins);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $validated['role'] = 'admin';

        return User::create($validated);
    }

    public function destroy($id)
    {
        $admin = User::findOrFail($id);
        if ($admin->role !== 'admin') {
            return response()->json(['message' => 'Only admins can be deleted'], 403);
        }

        $admin->delete();
        return response()->json(['message' => 'Admin deleted']);
    }
    public function update(Request $request, $id)
    {
        $admin = User::findOrFail($id);

        // Pastikan hanya admin yang bisa diubah
        if ($admin->role !== 'admin') {
            return response()->json(['message' => 'Only admins can be updated'], 403);
        }

        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $admin->id,
        ]);

        $admin->update($data);

        return response()->json($admin);
    }
}
